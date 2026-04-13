<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * DATA MIGRATION — no schema changes.
 *
 * up():
 *   1. Read all distinct non-null `kategori` text values from the articles table.
 *   2. For each unique value, create one row in artikel_kategoris (skip duplicates).
 *   3. Update each article's artikel_kategori_uuid to point to the matching row.
 *
 * down():
 *   Non-destructive — just nulls out artikel_kategori_uuid on all articles.
 *   The artikel_kategoris rows themselves are left in place (owned by the schema migration).
 */
class MigrateArtikelKategoriData extends Migration
{
    public function up()
    {
        // 1. Collect all distinct non-empty kategori text values from articles
        $distinctValues = DB::table('articles')
            ->select('kategori')
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori');

        // 2. Build a map: text_value → uuid (create if not exists)
        $map = [];
        foreach ($distinctValues as $value) {
            $trimmed = trim($value);
            if ($trimmed === '') {
                continue;
            }

            // Check if already exists (in case migration is re-run after partial failure)
            $existing = DB::table('artikel_kategoris')
                ->where('name', $trimmed)
                ->first();

            if ($existing) {
                $map[$trimmed] = $existing->uuid;
            } else {
                $uuid = (string) Str::uuid();
                $slug = Str::slug($trimmed);

                // Handle slug collisions
                $slugExists = DB::table('artikel_kategoris')->where('slug', $slug)->exists();
                if ($slugExists) {
                    $slug = $slug . '-' . Str::random(4);
                }

                DB::table('artikel_kategoris')->insert([
                    'uuid'       => $uuid,
                    'name'       => $trimmed,
                    'slug'       => $slug,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $map[$trimmed] = $uuid;
            }
        }

        // 3. Back-fill artikel_kategori_uuid on each article
        if (!empty($map)) {
            foreach ($map as $textValue => $uuid) {
                DB::table('articles')
                    ->where('kategori', $textValue)
                    ->whereNull('artikel_kategori_uuid')   // safe: skip already-migrated rows
                    ->update(['artikel_kategori_uuid' => $uuid]);
            }
        }
    }

    public function down()
    {
        // Non-destructive rollback — just clear back-filled UUIDs
        DB::table('articles')->update(['artikel_kategori_uuid' => null]);
    }
}

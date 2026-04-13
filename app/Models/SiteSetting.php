<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'group'];

    /**
     * Get a single setting value by key, with optional default.
     */
    public static function getValue(string $key, string $default = ''): string
    {
        $row = static::where('key', $key)->first();
        return $row ? ($row->value ?? $default) : $default;
    }

    /**
     * Get all settings in a specific group as an associative array [key => value].
     */
    public static function getGroup(string $group): array
    {
        return static::where('group', $group)
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Set (upsert) a single setting by key.
     */
    public static function setValue(string $key, string $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );
    }
}

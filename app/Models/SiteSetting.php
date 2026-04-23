<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = ['key', 'value', 'value_en', 'group'];

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
        $settings = static::where('group', $group)->get();
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting->key] = $setting->value;
            $result[$setting->key . '_en'] = $setting->value_en;
        }
        return $result;
    }

    /**
     * Set (upsert) a single setting by key.
     */
    public static function setValue(string $key, string $value, string $group = 'general', ?string $value_en = null): void
    {
        $data = ['value' => $value, 'group' => $group];
        if ($value_en !== null) {
            $data['value_en'] = $value_en;
        }
        static::updateOrCreate(
            ['key' => $key],
            $data
        );
    }
}

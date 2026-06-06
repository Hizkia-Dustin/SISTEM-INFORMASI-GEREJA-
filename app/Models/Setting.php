<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Get a setting value by key with fallback.
     */
    public static function get(string $key, $default = null)
    {
        try {
            $setting = static::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        } catch (\Throwable $e) {
            return $default;
        }
    }

    /**
     * Set a setting value by key.
     */
    public static function set(string $key, ?string $value)
    {
        try {
            return static::updateOrCreate(['key' => $key], ['value' => $value]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Failed to set config key {$key}: " . $e->getMessage());
            return null;
        }
    }
}

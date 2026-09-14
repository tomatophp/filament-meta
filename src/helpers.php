<?php

use TomatoPHP\FilamentMeta\Models\Meta;

if (! function_exists('meta')) {
    function meta(
        string $key,
        mixed $value = null,
        string $type = 'meta',
        ?string $date = null,
        ?string $time = null,
        string $response = 'ok',
    ): mixed {
        if ($value !== null) {
            if ($value === 'null') {
                return Meta::query()->updateOrCreate(['key' => $key], ['value' => null, 'key_value' => null]);
            } else {
                if ($type === 'key-value') {
                    return Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => null,
                        'key_value' => $value,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ]);
                } else {
                    return Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => $value,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ]);
                }
            }
        } else {
            $meta = Meta::query()->where('key', $key)->first();
            if ($meta) {
                if ($type === 'key-value') {
                    return $meta->key_value;
                } else {
                    return $meta->value;
                }

            } else {
                if (config('filament-meta.create')) {
                    return Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => null,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ]);
                }
            }
        }

        return null;
    }
}

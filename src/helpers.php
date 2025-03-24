<?php

if (! function_exists('meta')) {
    function meta(
        string $key,
        mixed $value = null,
        string $type = 'meta',
        string $date=null,
        string $time=null,
        string $response='ok',
    ): mixed
    {
        if ($value !== null) {
            if ($value === 'null') {
                return \TomatoPHP\FilamentMeta\Models\Meta::query()->updateOrCreate(['key' => $key], ['value' => null, 'key_value' => null]);
            } else {
                if($type === 'key-value'){
                    return \TomatoPHP\FilamentMeta\Models\Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => null,
                        'key_value' => $value,
                        'type' => $type,
                        'date' => $date??now()->toDateString(),
                        'time' => $time??now()->toTimeString(),
                        'response' => $response,
                    ]);
                }
                else {
                    return \TomatoPHP\FilamentMeta\Models\Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => $value,
                        'type' => $type,
                        'date' => $date??now()->toDateString(),
                        'time' => $time??now()->toTimeString(),
                        'response' => $response,
                    ]);
                }
            }
        } else {
            $meta = \TomatoPHP\FilamentMeta\Models\Meta::query()->where('key', $key)->first();
            if ($meta) {
                if($type === 'key-value'){
                    return $meta->key_value;
                }
                else {
                    return $meta->value;
                }

            } else {
                if(config('filament-meta.create')) {
                    return \TomatoPHP\FilamentMeta\Models\Meta::query()->updateOrCreate(['key' => $key], [
                        'value' => null,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ]);
                }
            }
        }
    }
}

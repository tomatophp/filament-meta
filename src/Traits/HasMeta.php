<?php

namespace TomatoPHP\FilamentMeta\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMeta
{
    public function modelMeta(): MorphMany
    {
        return $this->morphMany('TomatoPHP\FilamentMeta\Models\Meta', 'model');
    }

    public function meta(
        string $key,
        mixed $value = null,
        string $type = 'meta',
        ?string $date = null,
        ?string $time = null,
        string $response = 'ok',
    ): mixed {
        if ($value !== null) {
            if ($value === 'null') {
                return $this->modelMeta()->updateOrCreate(['key' => $key], ['value' => null, 'key_value' => null]);
            } else {
                if ($type === 'key-value') {
                    return $this->modelMeta()->updateOrCreate(['key' => $key], [
                        'value' => null,
                        'key_value' => $value,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ])->key_value;
                } else {
                    return $this->modelMeta()->updateOrCreate(['key' => $key], [
                        'value' => $value,
                        'type' => $type,
                        'date' => $date ?? now()->toDateString(),
                        'time' => $time ?? now()->toTimeString(),
                        'response' => $response,
                    ])->value;
                }
            }
        } else {
            $meta = $this->modelMeta()->where('key', $key)->first();
            if ($meta) {
                if ($type === 'key-value') {
                    return $meta->key_value;
                } else {
                    return $meta->value;
                }
            } else {
                if (config('filament-meta.create')) {
                    if ($type === 'key-value') {
                        return $this->modelMeta()->updateOrCreate(['key' => $key], [
                            'value' => null,
                            'type' => $type,
                            'date' => $date ?? now()->toDateString(),
                            'time' => $time ?? now()->toTimeString(),
                            'response' => $response,
                        ])->key_value;
                    } else {
                        return $this->modelMeta()->updateOrCreate(['key' => $key], [
                            'value' => null,
                            'type' => $type,
                            'date' => $date ?? now()->toDateString(),
                            'time' => $time ?? now()->toTimeString(),
                            'response' => $response,
                        ])->value;
                    }

                }
            }
        }
    }
}

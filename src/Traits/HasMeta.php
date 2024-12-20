<?php

namespace TomatoPHP\FilamentMeta\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasMeta
{
    public function modelMeta(): MorphMany
    {
        return $this->morphMany('TomatoPHP\FilamentMeta\Models\Meta', 'model');
    }

    public function meta(string $key, mixed $value = null): mixed
    {
        if ($value !== null) {
            if ($value === 'null') {
                return $this->modelMeta()->updateOrCreate(['key' => $key], ['value' => null]);
            } else {
                return $this->modelMeta()->updateOrCreate(['key' => $key], ['value' => $value]);
            }
        } else {
            $meta = $this->modelMeta()->where('key', $key)->first();
            if ($meta) {
                return $meta->value;
            } else {
                return $this->modelMeta()->updateOrCreate(['key' => $key], ['value' => null]);
            }
        }
    }
}

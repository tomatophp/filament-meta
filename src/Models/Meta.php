<?php

namespace TomatoPHP\FilamentMeta\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property int $id
 * @property string $model_id
 * @property string $model_type
 * @property string $connected_id
 * @property string $connected_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 */
class Meta extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'connected_id',
        'connected_type',
        'model_id',
        'model_type',
        'key',
        'value',
        'key_value',
        'date',
        'time',
        'response',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'value' => 'array',
    ];

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function connected(): MorphTo
    {
        return $this->morphTo();
    }
}

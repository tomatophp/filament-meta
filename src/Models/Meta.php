<?php

namespace TomatoPHP\FilamentMeta\Models;

use GeneaLabs\LaravelModelCaching\CachedModel;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property integer $id
 * @property string $model_id
 * @property string $model_type
 * @property string $connected_id
 * @property string $connected_type
 * @property string $key
 * @property mixed $value
 * @property string $created_at
 * @property string $updated_at
 */
class Meta extends CachedModel
{
    use Cachable;

    protected $cachePrefix = "tomato_meta_";

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
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'value' => 'array',
    ];

    /**
     * @return MorphTo
     */
    public function model(): MorphTo
   {
       return $this->morphTo();
   }


    /**
     * @return MorphTo
     */
    public function connected(): MorphTo
   {
       return $this->morphTo();
   }
}

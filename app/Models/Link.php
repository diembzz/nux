<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $key
 * @property boolean $active
 * @property string $expired_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Result[] $results
 */
class Link extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'key', 'active', 'expired_at', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function results(): HasMany
    {
        return $this->hasMany('App\Models\Result');
    }

    /**
     * @return string
     */
    public static function generateKey(): string
    {
        do {
            $key = Str::random(32);
        } while (Link::where('key', $key)->exists());

        return $key;
    }
}

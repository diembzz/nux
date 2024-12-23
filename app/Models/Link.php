<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $key
 * @property string $expired_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class Link extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'key', 'expired_at', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}

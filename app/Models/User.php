<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property string $username
 * @property string $phone_number
 * @property string $created_at
 * @property string $updated_at
 * @property Link[] $links
 */
class User extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['username', 'phone_number', 'created_at', 'updated_at'];

    /**
     * @return HasMany
     */
    public function links(): HasMany
    {
        return $this->hasMany('App\Models\Link');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $link_id
 * @property int $score
 * @property bool $win
 * @property int $sum
 * @property string $created_at
 * @property string $updated_at
 * @property Link $link
 */
class Result extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['link_id', 'score', 'win', 'sum', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function link(): BelongsTo
    {
        return $this->belongsTo('App\Models\Link');
    }
}

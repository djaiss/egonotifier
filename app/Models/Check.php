<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Check extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'source_id',
        'value',
    ];

    /**
     * Get the Source record associated with the action.
     *
     * @return BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(Source::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'url',
    ];

    /**
     * Get the action records associated with the step.
     *
     * @return HasMany
     */
    public function checks()
    {
        return $this->hasMany(Check::class);
    }
}

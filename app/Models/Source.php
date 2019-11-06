<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Source extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'repository',
        'valid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'valid' => 'boolean',
    ];

    /**
     * Get the action records associated with the source.
     *
     * @return HasMany
     */
    public function checks()
    {
        return $this->hasMany(Check::class);
    }

    /**
     * Get the user records associated with the source.
     *
     * @return belongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Return the latest check.
     *
     * @return Check
     */
    public function getLatestCheck(): Check
    {
        return $this->checks()->latest()->first();
    }

    /**
     * Get the next level for the given property for this source.
     *
     * @return null|int
     */
    public function getNextLevel(string $property)
    {
        $latestCheck = $this->checks()->latest()->first();

        if (!$latestCheck) {
            return;
        }

        return $latestCheck->{$property} + 1;
    }
}

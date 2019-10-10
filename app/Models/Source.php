<?php

namespace App\Models;

use App\Helpers\LevelHelper;
use App\User;
use ErrorException;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
     * Build the URL that needs to be fetched.
     *
     * @return string
     */
    public function buildUrl() : string
    {
        $url = '';
        if ($this->type == 'github') {
            $url = 'https://api.github.com/repos/'.$this->url;
        }

        return $url;
    }

    /**
     * Fetch the data of the source.
     *
     * @return void
     */
    public function fetch()
    {
        $response = Curl::to($this->buildUrl())
            ->withHeader('User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36')
            ->get();

        // curl the url
        // check the html code
        // check the number of stars


        $json = json_decode($response);

        try {
            $count = $json->stargazers_count;
        } catch (ErrorException $e) {
            $this->setInvalid();
            return;
        }

        $check = Check::create([
            'source_id' => $this->id,
            'value' => $count,
        ]);

        $this->checkLevels($check);
    }

    /**
     * Set the source as being invalid.
     *
     * @return void
     */
    public function setInvalid() : void
    {
        $this->valid = false;
        $this->save();
    }

    public function setCurrentLevel(Check $check)
    {

    }

    /**
     * Check whether the source has reached a level.
     *
     * @param Check $check
     * @return void
     */
    public function checkLevels(Check $check)
    {
        $previousLevel = $this->current_level;
        $actualLevel = LevelHelper::checkLevel($check->value);

        if ($previousLevel != $actualLevel) {
            return;
        }
    }

    public function warnUsers()
    {

    }
}

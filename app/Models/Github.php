<?php

namespace App\Models;

use Github\Client;
use Github\Exception\RuntimeException;

class Github
{
    /**
     * The source.
     *
     * @var Source
     */
    protected $source;

    /**
     * The repository.
     *
     * @var array
     */
    protected $repository;

    /**
     * Build the object.
     *
     * @param Source $source
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    /**
     * Make the call to the Github api to fetch repository information.
     *
     * @return array
     * @throws RuntimeException
     */
    public function fetch(): array
    {
        $client = new Client();
        $token = env('GITHUB_TOKEN');

        $client->authenticate($token, Client::AUTH_HTTP_TOKEN);
        $repo = $client->api('repo')->show($this->source->username, $this->source->repository);

        $data = [
            'watchers' => $repo['subscribers_count'],
            'stars' => $repo['stargazers_count'],
            'forks' => $repo['forks_count'],
        ];

        return $data;
    }
}

<?php

namespace Tests\Unit\Models;

use Tests\TestCase;
use App\Models\Github;
use App\Models\Source;
use Github\Exception\RuntimeException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GithubTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_repository_information(): void
    {
        $source = factory(Source::class)->create([]);
        $github = (new Github($source))->fetch();

        $this->assertTrue(
            array_key_exists('watchers', $github)
        );
        $this->assertTrue(
            array_key_exists('stars', $github)
        );
        $this->assertTrue(
            array_key_exists('forks', $github)
        );
    }

    /** @test */
    public function it_triggers_an_exception_if_not_found(): void
    {
        $source = factory(Source::class)->create([
            'username' => 'fff',
            'repository' => 'ddd',
        ]);

        $this->expectException(RuntimeException::class);
        $github = (new Github($source))->fetch();
    }
}

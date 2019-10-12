<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Source;
use App\Services\AddSource;
use App\Services\FetchSource;
use App\Exceptions\InvalidSourceException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FetchSourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_a_source() : void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'source_id' => $source->id,
        ];

        $source = (new FetchSource)->execute($request);

        $this->assertDatabaseHas('checks', [
            'id' => $source->id,
            'watchers' => 216,
            'watchers_level' => 20,
            'stars' => 7851,
            'stars_level' => 38,
            'forks' => 947,
            'forks_level' => 27,
            'commits' => 1750,
            'commits_level' => 29,
        ]);
    }

    /** @test */
    public function it_fetchs_a_source_marked_invalid_and_triggers_an_exception() : void
    {
        $source = factory(Source::class)->create([
            'valid' => false,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(InvalidSourceException::class);
        $source = (new FetchSource)->execute($request);
    }

    /** @test */
    public function it_fetchs_a_valid_source_which_is_actually_invalid_and_triggers_an_exception() : void
    {
        $source = factory(Source::class)->create([
            'url' => 'https://asdkfjals.com',
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(InvalidSourceException::class);
        $source = (new FetchSource)->execute($request);
    }

    /** @test */
    public function it_fetchs_a_valid_source_with_invalid_values() : void
    {
        $source = factory(Source::class)->create([
            'url' => 'https://github.com/djaiss/sample',
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(InvalidSourceException::class);
        $source = (new FetchSource)->execute($request);
    }

    public function it_fails_if_wrong_parameters_are_given(): void
    {
        $request = [];

        $this->expectException(ValidationException::class);
        (new AddSource)->execute($request);
    }
}

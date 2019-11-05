<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Source;
use App\Exceptions\InvalidSourceException;
use Illuminate\Validation\ValidationException;
use App\Services\FetchSourceInformationService;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FetchSourceInformationServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_fetches_a_source(): void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'source_id' => $source->id,
        ];

        $check = (new FetchSourceInformationService)->execute($request);

        $this->assertDatabaseHas('checks', [
            'id' => $check->id,
            'source_id' => $source->id,
        ]);

        $this->assertGreaterThan(
            0,
            $check->watchers
        );
    }

    /** @test */
    public function it_fetchs_a_source_marked_invalid_and_triggers_an_exception(): void
    {
        $source = factory(Source::class)->create([
            'valid' => false,
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(InvalidSourceException::class);
        $source = (new FetchSourceInformationService)->execute($request);
    }

    /** @test */
    public function it_fetchs_valid_source_which_is_actually_invalid_and_marks_it_invalid(): void
    {
        $source = factory(Source::class)->create([
            'username' => 'fff',
            'repository' => 'ddd',
        ]);

        $request = [
            'source_id' => $source->id,
        ];

        $this->expectException(InvalidSourceException::class);
        (new FetchSourceInformationService)->execute($request);
        $this->assertDatabaseHas('sources', [
            'id' => $source->id,
            'valid' => 0,
        ]);
    }

    public function it_fails_if_wrong_parameters_are_given(): void
    {
        $request = [];

        $this->expectException(ValidationException::class);
        (new FetchSourceInformationService)->execute($request);
    }
}

<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Source;
use App\Services\AddSourceService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddSourceServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_adds_a_source(): void
    {
        $request = [
            'username' => 'monicahq',
            'repository' => 'monica',
        ];

        $source = (new AddSourceService)->execute($request);

        $this->assertDatabaseHas('sources', [
            'id' => $source->id,
            'username' => 'monicahq',
            'repository' => 'monica',
        ]);

        $this->assertInstanceOf(
            Source::class,
            $source
        );
    }

    /** @test */
    public function it_adds_a_source_but_the_source_already_exists(): void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'username' => 'monicahq',
            'repository' => 'monica',
        ];

        (new AddSourceService)->execute($request);

        $this->assertDatabaseHas('sources', [
            'id' => $source->id,
            'username' => 'monicahq',
            'repository' => 'monica',
        ]);
    }

    /** @test */
    public function it_fails_if_wrong_parameters_are_given(): void
    {
        $request = [];

        $this->expectException(ValidationException::class);
        (new AddSourceService)->execute($request);
    }
}

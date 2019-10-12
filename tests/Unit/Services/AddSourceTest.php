<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Models\Source;
use App\Services\AddSource;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddSourceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_adds_a_source() : void
    {
        $request = [
            'url' => 'https://github.com',
        ];

        $source = (new AddSource)->execute($request);

        $this->assertDatabaseHas('sources', [
            'id' => $source->id,
            'type' => 'github.com',
            'url' => 'https://github.com',
        ]);

        $this->assertInstanceOf(
            Source::class,
            $source
        );
    }

    /** @test */
    public function it_adds_a_source_but_the_source_already_exists() : void
    {
        $source = factory(Source::class)->create([]);

        $request = [
            'url' => 'https://github.com/monicahq/monica',
        ];

        (new AddSource)->execute($request);

        $this->assertDatabaseHas('sources', [
            'id' => $source->id,
            'type' => 'github.com',
            'url' => 'https://github.com/monicahq/monica',
        ]);
    }

    /** @test */
    public function it_fails_if_wrong_parameters_are_given() : void
    {
        $request = [];

        $this->expectException(ValidationException::class);
        (new AddSource)->execute($request);
    }
}

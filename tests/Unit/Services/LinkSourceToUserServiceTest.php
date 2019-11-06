<?php

namespace Tests\Unit\Services;

use App\User;
use Tests\TestCase;
use App\Models\Source;
use App\Services\LinkSourceToUserService;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LinkSourceToUserServiceTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_links_a_source_to_the_user(): void
    {
        $source = factory(Source::class)->create([]);
        $user = factory(User::class)->create([]);
        $request = [
            'source_id' => $source->id,
            'user_id' => $user->id,
        ];

        (new LinkSourceToUserService)->execute($request);

        $this->assertDatabaseHas('source_user', [
            'source_id' => $source->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function it_fails_if_wrong_parameters_are_given(): void
    {
        $request = [];

        $this->expectException(ValidationException::class);
        (new LinkSourceToUserService)->execute($request);
    }
}

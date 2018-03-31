<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class AboutTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * Tests about route/page
     *
     * @return void
     */
    public function testAboutRoute()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/about')
            ->see('About');
    }

    /**
     * Tests about link
     *
     * @return void
     */
    public function testAboutClick()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/home')
            ->click('About')
            ->seePageIs('/about');
    }
}

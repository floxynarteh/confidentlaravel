<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LaracastsLinkTest extends DuskTestCase
{
    /**
     *
     *
     * @test
     */
    public function it_links_to_laracasts_in_laravel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Laracasts')
                    ->assertUrlIs('https://laracasts.com/');
        });
    }
}

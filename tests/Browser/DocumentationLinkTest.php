<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DocumentationLinkTest extends DuskTestCase
{
    /**
     *
     *
     * @test
     */
    public function it_links_to_documentation_in_laravel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Documentation')
                    ->assertUrlIs('https://laravel.com/docs/8.x');
        });
    }
}

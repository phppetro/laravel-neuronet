<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class WpTest extends DuskTestCase
{

    public function testCreateWp()
    {
        $admin = \App\User::find(1);
        $wp = factory('App\Wp')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $wp) {
            $browser->loginAs($admin)
                ->visit(route('admin.wps.index'))
                ->clickLink('Add new')
                ->type("name", $wp->name)
                ->press('Save')
                ->assertRouteIs('admin.wps.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $wp->name)
                ->logout();
        });
    }

    public function testEditWp()
    {
        $admin = \App\User::find(1);
        $wp = factory('App\Wp')->create();
        $wp2 = factory('App\Wp')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $wp, $wp2) {
            $browser->loginAs($admin)
                ->visit(route('admin.wps.index'))
                ->click('tr[data-entry-id="' . $wp->id . '"] .btn-info')
                ->type("name", $wp2->name)
                ->press('Update')
                ->assertRouteIs('admin.wps.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $wp2->name)
                ->logout();
        });
    }

    public function testShowWp()
    {
        $admin = \App\User::find(1);
        $wp = factory('App\Wp')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $wp) {
            $browser->loginAs($admin)
                ->visit(route('admin.wps.index'))
                ->click('tr[data-entry-id="' . $wp->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $wp->name)
                ->logout();
        });
    }

}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class EducationTest extends DuskTestCase
{

    public function testCreateEducation()
    {
        $admin = \App\User::find(1);
        $education = factory('App\Education')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $education) {
            $browser->loginAs($admin)
                ->visit(route('admin.education.index'))
                ->clickLink('Add new')
                ->type("name", $education->name)
                ->press('Save')
                ->assertRouteIs('admin.education.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $education->name)
                ->logout();
        });
    }

    public function testEditEducation()
    {
        $admin = \App\User::find(1);
        $education = factory('App\Education')->create();
        $education2 = factory('App\Education')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $education, $education2) {
            $browser->loginAs($admin)
                ->visit(route('admin.education.index'))
                ->click('tr[data-entry-id="' . $education->id . '"] .btn-info')
                ->type("name", $education2->name)
                ->press('Update')
                ->assertRouteIs('admin.education.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $education2->name)
                ->logout();
        });
    }

    public function testShowEducation()
    {
        $admin = \App\User::find(1);
        $education = factory('App\Education')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $education) {
            $browser->loginAs($admin)
                ->visit(route('admin.education.index'))
                ->click('tr[data-entry-id="' . $education->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $education->name)
                ->logout();
        });
    }

}

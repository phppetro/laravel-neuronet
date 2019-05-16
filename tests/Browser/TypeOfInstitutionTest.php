<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TypeOfInstitutionTest extends DuskTestCase
{

    public function testCreateTypeOfInstitution()
    {
        $admin = \App\User::find(1);
        $type_of_institution = factory('App\TypeOfInstitution')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $type_of_institution) {
            $browser->loginAs($admin)
                ->visit(route('admin.type_of_institutions.index'))
                ->clickLink('Add new')
                ->type("name", $type_of_institution->name)
                ->press('Save')
                ->assertRouteIs('admin.type_of_institutions.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $type_of_institution->name)
                ->logout();
        });
    }

    public function testEditTypeOfInstitution()
    {
        $admin = \App\User::find(1);
        $type_of_institution = factory('App\TypeOfInstitution')->create();
        $type_of_institution2 = factory('App\TypeOfInstitution')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $type_of_institution, $type_of_institution2) {
            $browser->loginAs($admin)
                ->visit(route('admin.type_of_institutions.index'))
                ->click('tr[data-entry-id="' . $type_of_institution->id . '"] .btn-info')
                ->type("name", $type_of_institution2->name)
                ->press('Update')
                ->assertRouteIs('admin.type_of_institutions.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $type_of_institution2->name)
                ->logout();
        });
    }

    public function testShowTypeOfInstitution()
    {
        $admin = \App\User::find(1);
        $type_of_institution = factory('App\TypeOfInstitution')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $type_of_institution) {
            $browser->loginAs($admin)
                ->visit(route('admin.type_of_institutions.index'))
                ->click('tr[data-entry-id="' . $type_of_institution->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $type_of_institution->name)
                ->logout();
        });
    }

}

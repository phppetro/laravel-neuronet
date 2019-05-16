<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProfessionalCategoryTest extends DuskTestCase
{

    public function testCreateProfessionalCategory()
    {
        $admin = \App\User::find(1);
        $professional_category = factory('App\ProfessionalCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $professional_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.professional_categories.index'))
                ->clickLink('Add new')
                ->type("name", $professional_category->name)
                ->press('Save')
                ->assertRouteIs('admin.professional_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $professional_category->name)
                ->logout();
        });
    }

    public function testEditProfessionalCategory()
    {
        $admin = \App\User::find(1);
        $professional_category = factory('App\ProfessionalCategory')->create();
        $professional_category2 = factory('App\ProfessionalCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $professional_category, $professional_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.professional_categories.index'))
                ->click('tr[data-entry-id="' . $professional_category->id . '"] .btn-info')
                ->type("name", $professional_category2->name)
                ->press('Update')
                ->assertRouteIs('admin.professional_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $professional_category2->name)
                ->logout();
        });
    }

    public function testShowProfessionalCategory()
    {
        $admin = \App\User::find(1);
        $professional_category = factory('App\ProfessionalCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $professional_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.professional_categories.index'))
                ->click('tr[data-entry-id="' . $professional_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $professional_category->name)
                ->logout();
        });
    }

}

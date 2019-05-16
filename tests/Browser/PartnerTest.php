<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartnerTest extends DuskTestCase
{

    public function testCreatePartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->make();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $partner, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->clickLink('Add new')
                ->type("name", $partner->name)
                ->select('select[name="projects[]"]', $relations[0]->id)
                ->select('select[name="projects[]"]', $relations[1]->id)
                ->select("type_of_institution_id", $partner->type_of_institution_id)
                ->select("country_id", $partner->country_id)
                ->press('Save')
                ->assertRouteIs('admin.partners.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partner->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='type_of_institution']", $partner->type_of_institution->name)
                ->assertSeeIn("tr:last-child td[field-key='country']", $partner->country->title)
                ->logout();
        });
    }

    public function testEditPartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->create();
        $partner2 = factory('App\Partner')->make();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
        ];

        $this->browse(function (Browser $browser) use ($admin, $partner, $partner2, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->click('tr[data-entry-id="' . $partner->id . '"] .btn-info')
                ->type("name", $partner2->name)
                ->select('select[name="projects[]"]', $relations[0]->id)
                ->select('select[name="projects[]"]', $relations[1]->id)
                ->select("type_of_institution_id", $partner2->type_of_institution_id)
                ->select("country_id", $partner2->country_id)
                ->press('Update')
                ->assertRouteIs('admin.partners.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partner2->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:last-child", $relations[1]->name)
                ->assertSeeIn("tr:last-child td[field-key='type_of_institution']", $partner2->type_of_institution->name)
                ->assertSeeIn("tr:last-child td[field-key='country']", $partner2->country->title)
                ->logout();
        });
    }

    public function testShowPartner()
    {
        $admin = \App\User::find(1);
        $partner = factory('App\Partner')->create();

        $relations = [
            factory('App\Project')->create(), 
            factory('App\Project')->create(), 
        ];

        $partner->projects()->attach([$relations[0]->id, $relations[1]->id]);

        $this->browse(function (Browser $browser) use ($admin, $partner, $relations) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners.index'))
                ->click('tr[data-entry-id="' . $partner->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $partner->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:first-child", $relations[0]->name)
                ->assertSeeIn("tr:last-child td[field-key='projects'] span:last-child", $relations[1]->name)
                ->assertSeeIn("td[field-key='type_of_institution']", $partner->type_of_institution->name)
                ->assertSeeIn("td[field-key='country']", $partner->country->title)
                ->logout();
        });
    }

}

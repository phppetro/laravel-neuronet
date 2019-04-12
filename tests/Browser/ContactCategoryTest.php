<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContactCategoryTest extends DuskTestCase
{

    public function testCreateContactCategory()
    {
        $admin = \App\User::find(1);
        $contact_category = factory('App\ContactCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_categories.index'))
                ->clickLink('Add new')
                ->type("name", $contact_category->name)
                ->press('Save')
                ->assertRouteIs('admin.contact_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_category->name)
                ->logout();
        });
    }

    public function testEditContactCategory()
    {
        $admin = \App\User::find(1);
        $contact_category = factory('App\ContactCategory')->create();
        $contact_category2 = factory('App\ContactCategory')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact_category, $contact_category2) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_categories.index'))
                ->click('tr[data-entry-id="' . $contact_category->id . '"] .btn-info')
                ->type("name", $contact_category2->name)
                ->press('Update')
                ->assertRouteIs('admin.contact_categories.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $contact_category2->name)
                ->logout();
        });
    }

    public function testShowContactCategory()
    {
        $admin = \App\User::find(1);
        $contact_category = factory('App\ContactCategory')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $contact_category) {
            $browser->loginAs($admin)
                ->visit(route('admin.contact_categories.index'))
                ->click('tr[data-entry-id="' . $contact_category->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $contact_category->name)
                ->logout();
        });
    }

}

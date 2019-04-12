<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ContactTest extends DuskTestCase
{

    public function testCreateContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->clickLink('Add new')
                ->type("first_name", $contact->first_name)
                ->type("last_name", $contact->last_name)
                ->select("category_id", $contact->category_id)
                ->type("phone1", $contact->phone1)
                ->type("phone2", $contact->phone2)
                ->type("email", $contact->email)
                ->type("skype", $contact->skype)
                ->type("address", $contact->address)
                ->press('Save')
                ->assertRouteIs('admin.contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $contact->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $contact->last_name)
                ->assertSeeIn("tr:last-child td[field-key='category']", $contact->category->name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $contact->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone2']", $contact->phone2)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $contact->skype)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact->address)
                ->logout();
        });
    }

    public function testEditContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->create();
        $contact2 = factory('App\Contact')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $contact, $contact2) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->click('tr[data-entry-id="' . $contact->id . '"] .btn-info')
                ->type("first_name", $contact2->first_name)
                ->type("last_name", $contact2->last_name)
                ->select("category_id", $contact2->category_id)
                ->type("phone1", $contact2->phone1)
                ->type("phone2", $contact2->phone2)
                ->type("email", $contact2->email)
                ->type("skype", $contact2->skype)
                ->type("address", $contact2->address)
                ->press('Update')
                ->assertRouteIs('admin.contacts.index')
                ->assertSeeIn("tr:last-child td[field-key='first_name']", $contact2->first_name)
                ->assertSeeIn("tr:last-child td[field-key='last_name']", $contact2->last_name)
                ->assertSeeIn("tr:last-child td[field-key='category']", $contact2->category->name)
                ->assertSeeIn("tr:last-child td[field-key='phone1']", $contact2->phone1)
                ->assertSeeIn("tr:last-child td[field-key='phone2']", $contact2->phone2)
                ->assertSeeIn("tr:last-child td[field-key='email']", $contact2->email)
                ->assertSeeIn("tr:last-child td[field-key='skype']", $contact2->skype)
                ->assertSeeIn("tr:last-child td[field-key='address']", $contact2->address)
                ->logout();
        });
    }

    public function testShowContact()
    {
        $admin = \App\User::find(1);
        $contact = factory('App\Contact')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $contact) {
            $browser->loginAs($admin)
                ->visit(route('admin.contacts.index'))
                ->click('tr[data-entry-id="' . $contact->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='first_name']", $contact->first_name)
                ->assertSeeIn("td[field-key='last_name']", $contact->last_name)
                ->assertSeeIn("td[field-key='category']", $contact->category->name)
                ->assertSeeIn("td[field-key='phone1']", $contact->phone1)
                ->assertSeeIn("td[field-key='phone2']", $contact->phone2)
                ->assertSeeIn("td[field-key='email']", $contact->email)
                ->assertSeeIn("td[field-key='skype']", $contact->skype)
                ->assertSeeIn("td[field-key='address']", $contact->address)
                ->logout();
        });
    }

}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DocumentTest extends DuskTestCase
{

    public function testCreateDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->clickLink('Add new')
                ->type("name", $document->name)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Save')
                ->assertRouteIs('admin.documents.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $document->name)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Document::first()->file . "']")
                ->logout();
        });
    }

    public function testEditDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->create();
        $document2 = factory('App\Document')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $document, $document2) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->click('tr[data-entry-id="' . $document->id . '"] .btn-info')
                ->type("name", $document2->name)
                ->attach("file", base_path("tests/_resources/test.jpg"))
                ->press('Update')
                ->assertRouteIs('admin.documents.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $document2->name)
                ->assertVisible("a[href='" . env("APP_URL") . "/" . env("UPLOAD_PATH") . "/" . \App\Document::first()->file . "']")
                ->logout();
        });
    }

    public function testShowDocument()
    {
        $admin = \App\User::find(1);
        $document = factory('App\Document')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $document) {
            $browser->loginAs($admin)
                ->visit(route('admin.documents.index'))
                ->click('tr[data-entry-id="' . $document->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $document->name)
                ->logout();
        });
    }

}

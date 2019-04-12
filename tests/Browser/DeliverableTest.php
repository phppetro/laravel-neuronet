<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class DeliverableTest extends DuskTestCase
{

    public function testCreateDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->clickLink('Add new')
                ->type("label", $deliverable->label)
                ->type("title", $deliverable->title)
                ->select("project_id", $deliverable->project_id)
                ->type("link", $deliverable->link)
                ->press('Save')
                ->assertRouteIs('admin.deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $deliverable->label)
                ->assertSeeIn("tr:last-child td[field-key='title']", $deliverable->title)
                ->assertSeeIn("tr:last-child td[field-key='project']", $deliverable->project->name)
                ->assertSeeIn("tr:last-child td[field-key='link']", $deliverable->link)
                ->logout();
        });
    }

    public function testEditDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->create();
        $deliverable2 = factory('App\Deliverable')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $deliverable, $deliverable2) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->click('tr[data-entry-id="' . $deliverable->id . '"] .btn-info')
                ->type("label", $deliverable2->label)
                ->type("title", $deliverable2->title)
                ->select("project_id", $deliverable2->project_id)
                ->type("link", $deliverable2->link)
                ->press('Update')
                ->assertRouteIs('admin.deliverables.index')
                ->assertSeeIn("tr:last-child td[field-key='label']", $deliverable2->label)
                ->assertSeeIn("tr:last-child td[field-key='title']", $deliverable2->title)
                ->assertSeeIn("tr:last-child td[field-key='project']", $deliverable2->project->name)
                ->assertSeeIn("tr:last-child td[field-key='link']", $deliverable2->link)
                ->logout();
        });
    }

    public function testShowDeliverable()
    {
        $admin = \App\User::find(1);
        $deliverable = factory('App\Deliverable')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $deliverable) {
            $browser->loginAs($admin)
                ->visit(route('admin.deliverables.index'))
                ->click('tr[data-entry-id="' . $deliverable->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='label']", $deliverable->label)
                ->assertSeeIn("td[field-key='title']", $deliverable->title)
                ->assertSeeIn("td[field-key='project']", $deliverable->project->name)
                ->assertSeeIn("td[field-key='link']", $deliverable->link)
                ->logout();
        });
    }

}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ActivityTest extends DuskTestCase
{

    public function testCreateActivity()
    {
        $admin = \App\User::find(1);
        $activity = factory('App\Activity')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $activity) {
            $browser->loginAs($admin)
                ->visit(route('admin.activities.index'))
                ->clickLink('Add new')
                ->select("user_id", $activity->user_id)
                ->type("date", $activity->date)
                ->type("body", $activity->body)
                ->press('Save')
                ->assertRouteIs('admin.activities.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $activity->user->name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $activity->date)
                ->assertSeeIn("tr:last-child td[field-key='body']", $activity->body)
                ->logout();
        });
    }

    public function testEditActivity()
    {
        $admin = \App\User::find(1);
        $activity = factory('App\Activity')->create();
        $activity2 = factory('App\Activity')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $activity, $activity2) {
            $browser->loginAs($admin)
                ->visit(route('admin.activities.index'))
                ->click('tr[data-entry-id="' . $activity->id . '"] .btn-info')
                ->select("user_id", $activity2->user_id)
                ->type("date", $activity2->date)
                ->type("body", $activity2->body)
                ->press('Update')
                ->assertRouteIs('admin.activities.index')
                ->assertSeeIn("tr:last-child td[field-key='user']", $activity2->user->name)
                ->assertSeeIn("tr:last-child td[field-key='date']", $activity2->date)
                ->assertSeeIn("tr:last-child td[field-key='body']", $activity2->body)
                ->logout();
        });
    }

    public function testShowActivity()
    {
        $admin = \App\User::find(1);
        $activity = factory('App\Activity')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $activity) {
            $browser->loginAs($admin)
                ->visit(route('admin.activities.index'))
                ->click('tr[data-entry-id="' . $activity->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='user']", $activity->user->name)
                ->assertSeeIn("td[field-key='date']", $activity->date)
                ->assertSeeIn("td[field-key='body']", $activity->body)
                ->logout();
        });
    }

}

<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class CalendarTest extends DuskTestCase
{

    public function testCreateCalendar()
    {
        $admin = \App\User::find(1);
        $calendar = factory('App\Calendar')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $calendar) {
            $browser->loginAs($admin)
                ->visit(route('admin.calendars.index'))
                ->clickLink('Add new')
                ->type("date", $calendar->date)
                ->type("title", $calendar->title)
                ->press('Save')
                ->assertRouteIs('admin.calendars.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $calendar->date)
                ->assertSeeIn("tr:last-child td[field-key='title']", $calendar->title)
                ->logout();
        });
    }

    public function testEditCalendar()
    {
        $admin = \App\User::find(1);
        $calendar = factory('App\Calendar')->create();
        $calendar2 = factory('App\Calendar')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $calendar, $calendar2) {
            $browser->loginAs($admin)
                ->visit(route('admin.calendars.index'))
                ->click('tr[data-entry-id="' . $calendar->id . '"] .btn-info')
                ->type("date", $calendar2->date)
                ->type("title", $calendar2->title)
                ->press('Update')
                ->assertRouteIs('admin.calendars.index')
                ->assertSeeIn("tr:last-child td[field-key='date']", $calendar2->date)
                ->assertSeeIn("tr:last-child td[field-key='title']", $calendar2->title)
                ->logout();
        });
    }

    public function testShowCalendar()
    {
        $admin = \App\User::find(1);
        $calendar = factory('App\Calendar')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $calendar) {
            $browser->loginAs($admin)
                ->visit(route('admin.calendars.index'))
                ->click('tr[data-entry-id="' . $calendar->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='date']", $calendar->date)
                ->assertSeeIn("td[field-key='title']", $calendar->title)
                ->logout();
        });
    }

}

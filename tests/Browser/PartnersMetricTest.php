<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PartnersMetricTest extends DuskTestCase
{

    public function testCreatePartnersMetric()
    {
        $admin = \App\User::find(1);
        $partners_metric = factory('App\PartnersMetric')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partners_metric) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners_metrics.index'))
                ->clickLink('Add new')
                ->type("name", $partners_metric->name)
                ->type("number", $partners_metric->number)
                ->press('Save')
                ->assertRouteIs('admin.partners_metrics.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partners_metric->name)
                ->assertSeeIn("tr:last-child td[field-key='number']", $partners_metric->number)
                ->logout();
        });
    }

    public function testEditPartnersMetric()
    {
        $admin = \App\User::find(1);
        $partners_metric = factory('App\PartnersMetric')->create();
        $partners_metric2 = factory('App\PartnersMetric')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $partners_metric, $partners_metric2) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners_metrics.index'))
                ->click('tr[data-entry-id="' . $partners_metric->id . '"] .btn-info')
                ->type("name", $partners_metric2->name)
                ->type("number", $partners_metric2->number)
                ->press('Update')
                ->assertRouteIs('admin.partners_metrics.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $partners_metric2->name)
                ->assertSeeIn("tr:last-child td[field-key='number']", $partners_metric2->number)
                ->logout();
        });
    }

    public function testShowPartnersMetric()
    {
        $admin = \App\User::find(1);
        $partners_metric = factory('App\PartnersMetric')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $partners_metric) {
            $browser->loginAs($admin)
                ->visit(route('admin.partners_metrics.index'))
                ->click('tr[data-entry-id="' . $partners_metric->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $partners_metric->name)
                ->assertSeeIn("td[field-key='number']", $partners_metric->number)
                ->logout();
        });
    }

}

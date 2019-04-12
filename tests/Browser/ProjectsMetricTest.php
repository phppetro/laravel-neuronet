<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectsMetricTest extends DuskTestCase
{

    public function testCreateProjectsMetric()
    {
        $admin = \App\User::find(1);
        $projects_metric = factory('App\ProjectsMetric')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $projects_metric) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects_metrics.index'))
                ->clickLink('Add new')
                ->type("name", $projects_metric->name)
                ->type("funding", $projects_metric->funding)
                ->press('Save')
                ->assertRouteIs('admin.projects_metrics.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $projects_metric->name)
                ->assertSeeIn("tr:last-child td[field-key='funding']", $projects_metric->funding)
                ->logout();
        });
    }

    public function testEditProjectsMetric()
    {
        $admin = \App\User::find(1);
        $projects_metric = factory('App\ProjectsMetric')->create();
        $projects_metric2 = factory('App\ProjectsMetric')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $projects_metric, $projects_metric2) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects_metrics.index'))
                ->click('tr[data-entry-id="' . $projects_metric->id . '"] .btn-info')
                ->type("name", $projects_metric2->name)
                ->type("funding", $projects_metric2->funding)
                ->press('Update')
                ->assertRouteIs('admin.projects_metrics.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $projects_metric2->name)
                ->assertSeeIn("tr:last-child td[field-key='funding']", $projects_metric2->funding)
                ->logout();
        });
    }

    public function testShowProjectsMetric()
    {
        $admin = \App\User::find(1);
        $projects_metric = factory('App\ProjectsMetric')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $projects_metric) {
            $browser->loginAs($admin)
                ->visit(route('admin.projects_metrics.index'))
                ->click('tr[data-entry-id="' . $projects_metric->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $projects_metric->name)
                ->assertSeeIn("td[field-key='funding']", $projects_metric->funding)
                ->logout();
        });
    }

}

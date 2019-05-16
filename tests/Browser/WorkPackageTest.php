<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class WorkPackageTest extends DuskTestCase
{

    public function testCreateWorkPackage()
    {
        $admin = \App\User::find(1);
        $work_package = factory('App\WorkPackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $work_package) {
            $browser->loginAs($admin)
                ->visit(route('admin.work_packages.index'))
                ->clickLink('Add new')
                ->select("name_id", $work_package->name_id)
                ->type("description", $work_package->description)
                ->select("project_id", $work_package->project_id)
                ->press('Save')
                ->assertRouteIs('admin.work_packages.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $work_package->name->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $work_package->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $work_package->project->name)
                ->logout();
        });
    }

    public function testEditWorkPackage()
    {
        $admin = \App\User::find(1);
        $work_package = factory('App\WorkPackage')->create();
        $work_package2 = factory('App\WorkPackage')->make();

        

        $this->browse(function (Browser $browser) use ($admin, $work_package, $work_package2) {
            $browser->loginAs($admin)
                ->visit(route('admin.work_packages.index'))
                ->click('tr[data-entry-id="' . $work_package->id . '"] .btn-info')
                ->select("name_id", $work_package2->name_id)
                ->type("description", $work_package2->description)
                ->select("project_id", $work_package2->project_id)
                ->press('Update')
                ->assertRouteIs('admin.work_packages.index')
                ->assertSeeIn("tr:last-child td[field-key='name']", $work_package2->name->name)
                ->assertSeeIn("tr:last-child td[field-key='description']", $work_package2->description)
                ->assertSeeIn("tr:last-child td[field-key='project']", $work_package2->project->name)
                ->logout();
        });
    }

    public function testShowWorkPackage()
    {
        $admin = \App\User::find(1);
        $work_package = factory('App\WorkPackage')->create();

        


        $this->browse(function (Browser $browser) use ($admin, $work_package) {
            $browser->loginAs($admin)
                ->visit(route('admin.work_packages.index'))
                ->click('tr[data-entry-id="' . $work_package->id . '"] .btn-primary')
                ->assertSeeIn("td[field-key='name']", $work_package->name->name)
                ->assertSeeIn("td[field-key='description']", $work_package->description)
                ->assertSeeIn("td[field-key='project']", $work_package->project->name)
                ->logout();
        });
    }

}

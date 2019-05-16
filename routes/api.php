<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('activities', 'ActivitiesController', ['except' => ['create', 'edit']]);

        Route::resource('contacts', 'ContactsController', ['except' => ['create', 'edit']]);

        Route::resource('contact_categories', 'ContactCategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('documents', 'DocumentsController', ['except' => ['create', 'edit']]);

        Route::resource('publications', 'PublicationsController', ['except' => ['create', 'edit']]);

        Route::resource('deliverables', 'DeliverablesController', ['except' => ['create', 'edit']]);

        Route::resource('calendars', 'CalendarsController', ['except' => ['create', 'edit']]);

        Route::resource('partners_metrics', 'PartnersMetricsController', ['except' => ['create', 'edit']]);

        Route::resource('projects_metrics', 'ProjectsMetricsController', ['except' => ['create', 'edit']]);

        Route::resource('type_of_institutions', 'TypeOfInstitutionsController', ['except' => ['create', 'edit']]);

        Route::resource('work_packages', 'WorkPackagesController', ['except' => ['create', 'edit']]);

        Route::resource('wps', 'WpsController', ['except' => ['create', 'edit']]);

});

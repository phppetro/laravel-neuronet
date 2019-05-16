<?php
//Frontend Routes...
Route::get('/', 'FrontController@home');
Route::get('disclaimer', 'FrontController@disclaimer');
Route::get('about-imi', 'FrontController@aboutimi');
Route::get('legal-notice', 'FrontController@legalnotice');
Route::get('privacy-policy', 'FrontController@privacypolicy');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Registration Routes..
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register')->name('auth.register');

//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
Route::group(['middleware' => ['auth', 'approved'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', 'Admin\DashboardController@index');
    Route::get('/calendar', 'Admin\SystemCalendarController@index')->name('admin.calendar');

    Route::resource('activities', 'Admin\ActivitiesController');
    Route::post('activities_mass_destroy', ['uses' => 'Admin\ActivitiesController@massDestroy', 'as' => 'activities.mass_destroy']);
    Route::post('activities_restore/{id}', ['uses' => 'Admin\ActivitiesController@restore', 'as' => 'activities.restore']);
    Route::delete('activities_perma_del/{id}', ['uses' => 'Admin\ActivitiesController@perma_del', 'as' => 'activities.perma_del']);
    Route::resource('contacts', 'Admin\ContactsController');
    Route::post('contacts_mass_destroy', ['uses' => 'Admin\ContactsController@massDestroy', 'as' => 'contacts.mass_destroy']);
    Route::post('contacts_restore/{id}', ['uses' => 'Admin\ContactsController@restore', 'as' => 'contacts.restore']);
    Route::delete('contacts_perma_del/{id}', ['uses' => 'Admin\ContactsController@perma_del', 'as' => 'contacts.perma_del']);
    Route::resource('contact_categories', 'Admin\ContactCategoriesController');
    Route::post('contact_categories_mass_destroy', ['uses' => 'Admin\ContactCategoriesController@massDestroy', 'as' => 'contact_categories.mass_destroy']);
    Route::post('contact_categories_restore/{id}', ['uses' => 'Admin\ContactCategoriesController@restore', 'as' => 'contact_categories.restore']);
    Route::delete('contact_categories_perma_del/{id}', ['uses' => 'Admin\ContactCategoriesController@perma_del', 'as' => 'contact_categories.perma_del']);
    Route::resource('documents', 'Admin\DocumentsController');
    Route::post('documents_mass_destroy', ['uses' => 'Admin\DocumentsController@massDestroy', 'as' => 'documents.mass_destroy']);
    Route::post('documents_restore/{id}', ['uses' => 'Admin\DocumentsController@restore', 'as' => 'documents.restore']);
    Route::delete('documents_perma_del/{id}', ['uses' => 'Admin\DocumentsController@perma_del', 'as' => 'documents.perma_del']);
    Route::resource('publications', 'Admin\PublicationsController');
    Route::post('publications_mass_destroy', ['uses' => 'Admin\PublicationsController@massDestroy', 'as' => 'publications.mass_destroy']);
    Route::post('publications_restore/{id}', ['uses' => 'Admin\PublicationsController@restore', 'as' => 'publications.restore']);
    Route::delete('publications_perma_del/{id}', ['uses' => 'Admin\PublicationsController@perma_del', 'as' => 'publications.perma_del']);
    Route::resource('projects', 'Admin\ProjectsController');
    Route::post('projects_mass_destroy', ['uses' => 'Admin\ProjectsController@massDestroy', 'as' => 'projects.mass_destroy']);
    Route::post('projects_restore/{id}', ['uses' => 'Admin\ProjectsController@restore', 'as' => 'projects.restore']);
    Route::delete('projects_perma_del/{id}', ['uses' => 'Admin\ProjectsController@perma_del', 'as' => 'projects.perma_del']);
    Route::resource('deliverables', 'Admin\DeliverablesController');
    Route::post('deliverables_mass_destroy', ['uses' => 'Admin\DeliverablesController@massDestroy', 'as' => 'deliverables.mass_destroy']);
    Route::post('deliverables_restore/{id}', ['uses' => 'Admin\DeliverablesController@restore', 'as' => 'deliverables.restore']);
    Route::delete('deliverables_perma_del/{id}', ['uses' => 'Admin\DeliverablesController@perma_del', 'as' => 'deliverables.perma_del']);
    Route::resource('calendars', 'Admin\CalendarsController');
    Route::post('calendars_mass_destroy', ['uses' => 'Admin\CalendarsController@massDestroy', 'as' => 'calendars.mass_destroy']);
    Route::post('calendars_restore/{id}', ['uses' => 'Admin\CalendarsController@restore', 'as' => 'calendars.restore']);
    Route::delete('calendars_perma_del/{id}', ['uses' => 'Admin\CalendarsController@perma_del', 'as' => 'calendars.perma_del']);
    Route::resource('partners_metrics', 'Admin\PartnersMetricsController');
    Route::post('partners_metrics_mass_destroy', ['uses' => 'Admin\PartnersMetricsController@massDestroy', 'as' => 'partners_metrics.mass_destroy']);
    Route::post('partners_metrics_restore/{id}', ['uses' => 'Admin\PartnersMetricsController@restore', 'as' => 'partners_metrics.restore']);
    Route::delete('partners_metrics_perma_del/{id}', ['uses' => 'Admin\PartnersMetricsController@perma_del', 'as' => 'partners_metrics.perma_del']);
    Route::resource('projects_metrics', 'Admin\ProjectsMetricsController');
    Route::post('projects_metrics_mass_destroy', ['uses' => 'Admin\ProjectsMetricsController@massDestroy', 'as' => 'projects_metrics.mass_destroy']);
    Route::post('projects_metrics_restore/{id}', ['uses' => 'Admin\ProjectsMetricsController@restore', 'as' => 'projects_metrics.restore']);
    Route::delete('projects_metrics_perma_del/{id}', ['uses' => 'Admin\ProjectsMetricsController@perma_del', 'as' => 'projects_metrics.perma_del']);
    Route::resource('faq_categories', 'Admin\FaqCategoriesController');
    Route::post('faq_categories_mass_destroy', ['uses' => 'Admin\FaqCategoriesController@massDestroy', 'as' => 'faq_categories.mass_destroy']);
    Route::resource('faq_questions', 'Admin\FaqQuestionsController');
    Route::post('faq_questions_mass_destroy', ['uses' => 'Admin\FaqQuestionsController@massDestroy', 'as' => 'faq_questions.mass_destroy']);

    Route::resource('content_categories', 'Admin\ContentCategoriesController');
    Route::post('content_categories_mass_destroy', ['uses' => 'Admin\ContentCategoriesController@massDestroy', 'as' => 'content_categories.mass_destroy']);
    Route::resource('content_tags', 'Admin\ContentTagsController');
    Route::post('content_tags_mass_destroy', ['uses' => 'Admin\ContentTagsController@massDestroy', 'as' => 'content_tags.mass_destroy']);
    Route::resource('content_pages', 'Admin\ContentPagesController');
    Route::post('content_pages_mass_destroy', ['uses' => 'Admin\ContentPagesController@massDestroy', 'as' => 'content_pages.mass_destroy']);

    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('user_actions', 'Admin\UserActionsController');

    Route::resource('professional_categories', 'Admin\ProfessionalCategoriesController');
    Route::post('professional_categories_mass_destroy', ['uses' => 'Admin\ProfessionalCategoriesController@massDestroy', 'as' => 'professional_categories.mass_destroy']);
    Route::post('professional_categories_restore/{id}', ['uses' => 'Admin\ProfessionalCategoriesController@restore', 'as' => 'professional_categories.restore']);
    Route::delete('professional_categories_perma_del/{id}', ['uses' => 'Admin\ProfessionalCategoriesController@perma_del', 'as' => 'professional_categories.perma_del']);

    Route::resource('education', 'Admin\EducationController');
    Route::post('education_mass_destroy', ['uses' => 'Admin\EducationController@massDestroy', 'as' => 'education.mass_destroy']);
    Route::post('education_restore/{id}', ['uses' => 'Admin\EducationController@restore', 'as' => 'education.restore']);
    Route::delete('education_perma_del/{id}', ['uses' => 'Admin\EducationController@perma_del', 'as' => 'education.perma_del']);

    Route::resource('countries', 'Admin\CountriesController');
    Route::post('countries_mass_destroy', ['uses' => 'Admin\CountriesController@massDestroy', 'as' => 'countries.mass_destroy']);
    Route::post('countries_restore/{id}', ['uses' => 'Admin\CountriesController@restore', 'as' => 'countries.restore']);
    Route::delete('countries_perma_del/{id}', ['uses' => 'Admin\CountriesController@perma_del', 'as' => 'countries.perma_del']);

    Route::resource('type_of_institutions', 'Admin\TypeOfInstitutionsController');
    Route::post('type_of_institutions_mass_destroy', ['uses' => 'Admin\TypeOfInstitutionsController@massDestroy', 'as' => 'type_of_institutions.mass_destroy']);
    Route::post('type_of_institutions_restore/{id}', ['uses' => 'Admin\TypeOfInstitutionsController@restore', 'as' => 'type_of_institutions.restore']);
    Route::delete('type_of_institutions_perma_del/{id}', ['uses' => 'Admin\TypeOfInstitutionsController@perma_del', 'as' => 'type_of_institutions.perma_del']);

    Route::resource('partners', 'Admin\PartnersController');
    Route::post('partners_mass_destroy', ['uses' => 'Admin\PartnersController@massDestroy', 'as' => 'partners.mass_destroy']);
    Route::post('partners_restore/{id}', ['uses' => 'Admin\PartnersController@restore', 'as' => 'partners.restore']);
    Route::delete('partners_perma_del/{id}', ['uses' => 'Admin\PartnersController@perma_del', 'as' => 'partners.perma_del']);

    Route::resource('work_packages', 'Admin\WorkPackagesController');
    Route::post('work_packages_mass_destroy', ['uses' => 'Admin\WorkPackagesController@massDestroy', 'as' => 'work_packages.mass_destroy']);
    Route::post('work_packages_restore/{id}', ['uses' => 'Admin\WorkPackagesController@restore', 'as' => 'work_packages.restore']);
    Route::delete('work_packages_perma_del/{id}', ['uses' => 'Admin\WorkPackagesController@perma_del', 'as' => 'work_packages.perma_del']);

    Route::resource('wps', 'Admin\WpsController');
    Route::post('wps_mass_destroy', ['uses' => 'Admin\WpsController@massDestroy', 'as' => 'wps.mass_destroy']);
    Route::post('wps_restore/{id}', ['uses' => 'Admin\WpsController@restore', 'as' => 'wps.restore']);
    Route::delete('wps_perma_del/{id}', ['uses' => 'Admin\WpsController@perma_del', 'as' => 'wps.perma_del']);

    Route::post('csv_parse', 'Admin\CsvImportController@parse')->name('csv_parse');
    Route::post('csv_process', 'Admin\CsvImportController@process')->name('csv_process');

    Route::get('search', 'MegaSearchController@search')->name('mega-search');
    Route::get('language/{lang}', function ($lang) {
        return redirect()->back()->withCookie(cookie()->forever('language', $lang));
    })->name('language');});

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           'name'     => 'required|max:255',
           'surname'  => 'required|max:255',
           'email'    => 'required|email|max:255|unique:users',
           'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
      $user = User::create([
          'name'                     => $data['name'],
          'surname'                  => $data['surname'],
          'email'                    => $data['email'],
          'password'                 => bcrypt($data['password']),
          'institution'              => $data['institution'],
          'project_id'               => $data['project_id'],
          'professional_category_id' => $data['professional_category_id'],
          'education_id'             => $data['education_id'],
          'country_id'               => $data['country_id'],
        ]);

        $user->role()->attach(config('app_service.default_registration_role_id'));

        return $user;
    }

    public function showRegistrationForm()
    {
        $projects = \App\Project::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $professional_categories = \App\ProfessionalCategory::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $education = \App\Education::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $countries = \App\Country::get()->pluck('title', 'id')->prepend(trans('global.app_please_select'), '');// get all countries
        return view('auth.register', compact('projects', 'professional_categories', 'education', 'countries'));
    }
}

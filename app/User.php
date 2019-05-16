<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $password
 * @property string $project
 * @property string $professional_category
 * @property string $education
 * @property string $institution
 * @property string $country
 * @property string $photo
 * @property string $remember_token
 * @property tinyInteger $approved
*/
class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = ['name', 'surname', 'email', 'password', 'institution', 'photo', 'remember_token', 'approved', 'project_id', 'professional_category_id', 'education_id', 'country_id'];
    protected $hidden = ['password', 'remember_token'];
    public static $searchable = [
    ];

    public static function boot()
    {
        parent::boot();

        User::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }


    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProfessionalCategoryIdAttribute($input)
    {
        $this->attributes['professional_category_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setEducationIdAttribute($input)
    {
        $this->attributes['education_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCountryIdAttribute($input)
    {
        $this->attributes['country_id'] = $input ? $input : null;
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }

    public function professional_category()
    {
        return $this->belongsTo(ProfessionalCategory::class, 'professional_category_id')->withTrashed();
    }

    public function education()
    {
        return $this->belongsTo(Education::class, 'education_id')->withTrashed();
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withTrashed();
    }




    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }
}

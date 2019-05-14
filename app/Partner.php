<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Partner
 *
 * @package App
 * @property string $name
 * @property string $type_of_institution
 * @property string $country
*/
class Partner extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'type_of_institution_id', 'country_id'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    
    public static function boot()
    {
        parent::boot();

        Partner::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTypeOfInstitutionIdAttribute($input)
    {
        $this->attributes['type_of_institution_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCountryIdAttribute($input)
    {
        $this->attributes['country_id'] = $input ? $input : null;
    }
    
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'partner_project')->withTrashed();
    }
    
    public function type_of_institution()
    {
        return $this->belongsTo(TypeOfInstitution::class, 'type_of_institution_id')->withTrashed();
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id')->withTrashed();
    }
    
}

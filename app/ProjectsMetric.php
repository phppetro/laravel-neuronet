<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProjectsMetric
 *
 * @package App
 * @property string $name
 * @property double $funding
*/
class ProjectsMetric extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'funding'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ProjectsMetric::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setFundingAttribute($input)
    {
        if ($input != '') {
            $this->attributes['funding'] = $input;
        } else {
            $this->attributes['funding'] = null;
        }
    }
    
}

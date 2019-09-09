<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class WorkPackage
 *
 * @package App
 * @property string $wp_number
 * @property string $description
 * @property string $project
*/
class WorkPackage extends Model
{
    use SoftDeletes;

    protected $fillable = ['description', 'wp_number_id', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        WorkPackage::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setWpNumberIdAttribute($input)
    {
        $this->attributes['wp_number_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function wp_number()
    {
        return $this->belongsTo(Wp::class, 'wp_number_id')->withTrashed();
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deliverable
 *
 * @package App
 * @property string $label
 * @property string $title
 * @property string $project
 * @property string $link
*/
class Deliverable extends Model
{
    use SoftDeletes;

    protected $fillable = ['label', 'title', 'link', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'label',
        'title',
    ];
    
    public static function boot()
    {
        parent::boot();

        Deliverable::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setProjectIdAttribute($input)
    {
        $this->attributes['project_id'] = $input ? $input : null;
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}

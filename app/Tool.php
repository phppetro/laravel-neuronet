<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tool
 *
 * @package App
 * @property string $name
 * @property string $project
 * @property string $description
 * @property string $keywords
 * @property string $link
*/
class Tool extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'keywords', 'link', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'name',
        'description',
        'keywords',
        'link',
    ];
    
    public static function boot()
    {
        parent::boot();

        Tool::observe(new \App\Observers\UserActionsObserver);
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

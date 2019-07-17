<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Publication
 *
 * @package App
 * @property string $title
 * @property string $first_author_last_name
 * @property string $year
 * @property string $project
 * @property string $link
 * @property string $keywords
*/
class Publication extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'first_author_last_name', 'year', 'link', 'keywords', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'first_author_last_name',
        'keywords',
    ];
    
    public static function boot()
    {
        parent::boot();

        Publication::observe(new \App\Observers\UserActionsObserver);
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

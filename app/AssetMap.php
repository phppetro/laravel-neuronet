<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AssetMap
 *
 * @package App
 * @property string $title
 * @property text $body
 * @property string $target
 */
class AssetMap extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'body', 'target', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'body',
    ];

    public static function boot()
    {
        parent::boot();

        DecisionTool::observe(new \App\Observers\UserActionsObserver);
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
<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tool
 *
 * @package App
 * @property string $name
 * @property string $project
 * @property string $publication_date
 * @property string $type_of_data_available
 * @property text $description
 * @property string $keywords
 * @property string $link
*/
class Tool extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'publication_date', 'type_of_data_available', 'description', 'keywords', 'link', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'name',
        'publication_date',
        'type_of_data_available',
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

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPublicationDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['publication_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['publication_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPublicationDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id')->withTrashed();
    }
    
}

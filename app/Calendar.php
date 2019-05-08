<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Calendar
 *
 * @package App
 * @property string $date
 * @property string $title
 * @property string $project
 * @property string $location
*/
class Calendar extends Model
{
    use SoftDeletes;

    protected $fillable = ['date', 'title', 'location', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'title',
    ];
    
    public static function boot()
    {
        parent::boot();

        Calendar::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $input)->format('Y-m-d H:i:s');
        } else {
            $this->attributes['date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format') . ' H:i:s');

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $input)->format(config('app.date_format') . ' H:i:s');
        } else {
            return '';
        }
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

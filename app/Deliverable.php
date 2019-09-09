<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Deliverable
 *
 * @package App
 * @property string $deliverable_number
 * @property string $title
 * @property string $project
 * @property string $submission_date
 * @property string $link
 * @property text $keywords
*/
class Deliverable extends Model
{
    use SoftDeletes;

    protected $fillable = ['deliverable_number', 'title', 'submission_date', 'link', 'keywords', 'project_id'];
    protected $hidden = [];
    public static $searchable = [
        'deliverable_number',
        'title',
        'submission_date',
        'keywords',
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

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSubmissionDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['submission_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['submission_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSubmissionDateAttribute($input)
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

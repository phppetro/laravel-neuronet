<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class HighlightsMetric
 *
 * @package App
 * @property string $name
 * @property integer $number
 * @property integer $order
 * @property string $image
 *
 */
class HighlightsMetric extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'number', 'order', 'image'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];

    public static function boot()
    {
        parent::boot();

        HighlightsMetric::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNumberAttribute($input)
    {
        $this->attributes['number'] = $input ? $input : null;
    }

}

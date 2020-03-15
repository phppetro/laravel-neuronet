<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CountriesMetric
 *
 * @package App
 * @property string $name
 * @property integer $number
 */
class CountriesMetric extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'number'];
    protected $hidden = [];
    public static $searchable = [
    ];

    public static function boot()
    {
        parent::boot();

        CountriesMetric::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setNumberAttribute($input)
    {
        $this->attributes['number'] = $input ? $input : null;
    }

}
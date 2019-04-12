<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PartnersMetric
 *
 * @package App
 * @property string $name
 * @property integer $number
*/
class PartnersMetric extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'number'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    
    public static function boot()
    {
        parent::boot();

        PartnersMetric::observe(new \App\Observers\UserActionsObserver);
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

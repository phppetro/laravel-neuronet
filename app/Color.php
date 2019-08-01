<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Color
 *
 * @package App
 * @property string $color
 * @property string $value
*/
class Color extends Model
{
    use SoftDeletes;

    protected $fillable = ['color', 'value'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Color::observe(new \App\Observers\UserActionsObserver);
    }
    
}

<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Education
 *
 * @package App
 * @property string $name
*/
class Education extends Model
{
    use SoftDeletes;

    
    protected $table = "education";
    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        Education::observe(new \App\Observers\UserActionsObserver);
    }
    
}

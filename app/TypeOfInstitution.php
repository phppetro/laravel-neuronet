<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TypeOfInstitution
 *
 * @package App
 * @property string $name
*/
class TypeOfInstitution extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        TypeOfInstitution::observe(new \App\Observers\UserActionsObserver);
    }
    
}

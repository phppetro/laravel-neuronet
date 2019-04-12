<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ContactCategory
 *
 * @package App
 * @property string $name
*/
class ContactCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
        'name',
    ];
    
    public static function boot()
    {
        parent::boot();

        ContactCategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}

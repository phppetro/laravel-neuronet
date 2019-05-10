<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProfessionalCategory
 *
 * @package App
 * @property string $name
*/
class ProfessionalCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    public static function boot()
    {
        parent::boot();

        ProfessionalCategory::observe(new \App\Observers\UserActionsObserver);
    }
    
}

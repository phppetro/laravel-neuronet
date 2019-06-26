<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Contact
 *
 * @package App
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $position
 * @property string $institution
 * @property string $category
 * @property string $projects_involved
 * @property text $expertise
*/
class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'last_name', 'email', 'position', 'institution', 'projects_involved', 'expertise', 'category_id'];
    protected $hidden = [];
    public static $searchable = [
        'position',
        'institution',
        'projects_involved',
        'expertise',
    ];
    
    public static function boot()
    {
        parent::boot();

        Contact::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCategoryIdAttribute($input)
    {
        $this->attributes['category_id'] = $input ? $input : null;
    }
    
    public function category()
    {
        return $this->belongsTo(ContactCategory::class, 'category_id')->withTrashed();
    }
    
}

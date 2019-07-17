<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Document
 *
 * @package App
 * @property string $title
 * @property string $source
 * @property string $publication_date
 * @property text $keywords
 * @property string $file
*/
class Document extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'source', 'publication_date', 'keywords', 'file'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'publication_date',
        'keywords',
    ];
    
    public static function boot()
    {
        parent::boot();

        Document::observe(new \App\Observers\UserActionsObserver);
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setPublicationDateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['publication_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['publication_date'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getPublicationDateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
    
}

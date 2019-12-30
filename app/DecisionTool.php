<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DecisionTool
 *
 * @package App
 * @property string $title
 * @property text $body
 * @property string $target
 */
class DecisionTool extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'body', 'target'];
    protected $hidden = [];
    public static $searchable = [
        'title',
        'body',
    ];

    public static function boot()
    {
        parent::boot();

        DecisionTool::observe(new \App\Observers\UserActionsObserver);
    }

}

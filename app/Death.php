<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Death extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['date'];

    /*public function getDateAttribute($date)
    {
        return Carbon::parse($date)->toDateString();
    }*/
}

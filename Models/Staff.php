<?php

namespace Frankli\Itearoa\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Staff
 */
class Staff extends Model
{

    protected $table = 'hotel_staff';

    protected $guarded = [];

    public $timestamps = false;


    public function orders()
    {
        return $this->hasMany(ShoppingOrder::class, 'adminid');
    }

}

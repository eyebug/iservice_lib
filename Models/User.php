<?php

namespace Frankli\Itearoa\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class User
 */
class User extends Model
{

    protected $table = 'hotel_user';

    protected $guarded = [];

    protected $hidden = ['pin_code'];

    public $timestamps = false;


    public function orders()
    {
        return $this->hasMany(ShoppingOrder::class, 'userid');
    }

}

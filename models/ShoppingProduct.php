<?php

namespace Frankli\Itearoa\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * Class ShoppingProduct
 */
class ShoppingProduct extends Model
{

    protected $table = 'hotel_shopping';

    protected $guarded = [];

    public $timestamps = false;


    public function order()
    {
        return $this->belongsToMany(ShoppingOrder::class, 'orders_products', 'product_id', 'order_id');
    }

}

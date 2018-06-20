<?php

namespace Frankli\Itearoa\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Capsule\Manager as DB;


/**
 * Class ShoppingOrder
 */
class ShoppingOrder extends Model
{

    protected $table = 'shopping_orders';

    protected $guarded = [];

    public $timestamps = false;


    public function products()
    {
        return $this->belongsToMany(ShoppingProduct::class, 'orders_products', 'order_id', 'product_id')
            ->withPivot('count', 'status', 'robot_status', 'robot_taskid', 'updated_at', 'id', 'memo');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'adminid');
    }


    public static function addProducts(array $data)
    {
        $result = DB::table('orders_products')->insert($data);
        return $result;
    }

}

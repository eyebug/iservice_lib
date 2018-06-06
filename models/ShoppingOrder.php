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


    /**
     * Update the order status when all products have the same status
     *
     * @param array $orderIdArray
     */
    public static function syncOrder(array $orderIdArray)
    {
        $orders = self::with('user', 'products')->whereIn('id', $orderIdArray)->get();
        foreach ($orders as $order) {
            $flag = true;
            $status = $order->products[0]->pivot->status;
            foreach ($order->products as $product) {
                if ($status != $product->pivot->status) {
                    $flag = false;
                    break;
                }
            }
            if ($flag) {
                $order->status = $status;
                $order->save();
            }
        }
    }

    public static function addProducts(array $data)
    {
        $result = DB::table('orders_products')->insert($data);
        return $result;
    }

}

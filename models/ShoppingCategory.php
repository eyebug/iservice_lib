<?php

namespace Frankli\Itearoa\Models;

use Illuminate\Database\Eloquent\Model;



/**
 * Class ShoppingTagModel
 * 购物信息标签管理
 */
class ShoppingCategory extends Model
{

    protected $table = 'hotel_shopping_tag';
    public $timestamps = false;

    public function children()
    {
        return $this->hasMany(static::class, 'parentid');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parentid');
    }


    public function getCategoryTree()
    {

    }

}

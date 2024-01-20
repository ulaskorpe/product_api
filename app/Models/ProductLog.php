<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductLog extends Model
{
    use HasFactory,SoftDeletes;

    protected  $table = 'product_logs';

    protected $fillable = ['name','price','status','user_id' ,'product_id','process','type'];

    public function user():HasOne{
        return $this->hasOne(User::class,'id','user_id' );
    }

    public function product():HasOne{
        return $this->hasOne(Product::class ,'id','product_id');
    }
}

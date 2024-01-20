<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected  $table = 'products';

    protected $fillable = ['name','price','status','user_id','type'];

    public function user():HasOne{
        return $this->hasOne(User::class,'id','user_id' );
    }

    public function product_logs():HasMany{
        return $this->hasMany(ProductLog::class,'product_id','id');
    }
}

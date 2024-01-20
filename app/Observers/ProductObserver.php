<?php

namespace App\Observers;
use App\Mail\ProductCreatedEmail;
use App\Models\Product;
use App\Models\ProductLog;
 
use Log;
use Auth;
use Illuminate\Support\Facades\Mail;
class ProductObserver
{
    public function updating(Product $product)
    {
        
      $originalAttributes =  $product->getOriginal() ;

 
      $product_log = new ProductLog();
      $product_log->name = $originalAttributes['name'];
      $product_log->price = $originalAttributes['price'];
      $product_log->status = $originalAttributes['status'];
      $product_log->user_id = Auth::id();
      $product_log->product_id = $product->id;
      $product_log->type = $originalAttributes['type'];
      $product_log->process = 'updated';
      $product_log->save();
        Log::channel('data_check')->info(json_encode($product->getOriginal()));
    }

    public function created(Product $product){
         
      $product_log = new ProductLog();
      $product_log->name = $product['name'];
      $product_log->price = $product['price'];
      $product_log->status = $product['status'];
      $product_log->user_id = $product['user_id'];
      $product_log->product_id = $product['id'];
      $product_log->type = $product['type'];
      $product_log->process = 'created';
      $product_log->save();

      Mail::to($product->user()->first()->email)
      ->send(new ProductCreatedEmail($product->user()->first()->name,$product->name));

    }

    public function deleted(Product $product){
        ProductLog::where('product_id','=',$product['id'])->delete();
    }
 
}

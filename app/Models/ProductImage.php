<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\product;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id','image_path'];

    public function product(){
        return $this->belongsTo(product::class);
    }

    public function getImageUrlAttribute(){
    //    return Storage::disk('uploads')->url($this->image_path);
        
        if($this->image_path){
            return asset('uploads/'. $this->image_path);
        }
        return asset('images/default.jpg'); 
    }
}

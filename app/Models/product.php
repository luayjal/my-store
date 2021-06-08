<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'category_id','store_id','description','image', 'price','sale_price','quantity', 'status'];
 
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }

    public function tags(){
        return $this->belongsToMany(
            Tag::class,
            'product_tag',
            'product_id',
            'tags_id',
            'id',
            'id'
        );
    }

    //Accessers:
    //get{AttrName}Attribute
    //image_url
    public function getImageUrlAttribute(){
        if($this->image){
            return asset('uploads/'. $this->image);
        }
        return asset('images/default.jpg');
    }

    //mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Str::title($value);
    }
    public static function validateRules(){
        return[
            'name'=>'required|string|max:225|min:3',
            'category_id'=>'required|exists:categories,id',
            'image'=>'image',
            'price'=>'numeric|min:0',
            'sale_price'=>['numeric','min:0',function($attr,$value,$fail){
                $price = request()->input('price');
                if($value >= $price){
                    $fail($attr.' must be less than regular price');
                }
            }],

            ''=>'',
            ''=>'',
        ];
    }
}

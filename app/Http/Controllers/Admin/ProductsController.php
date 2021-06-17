<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::with('category')
        ->latest()
        ->orderBy('name','ASC')
        ->paginate(5);

        return view('admin.products.index',[
            'products' => $products,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',[
            'product'=> new product(),
            'categories'=>Category::all(),
            'tags'=>''
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request->validate(product::validateRules());
    
       /*   $data = $request->all();
         $data['slug'] = Str::slug($data['name']);
       $product = product::create($data);
 */
      
       $request->merge([
        'slug' => Str::slug($request->post('name')),
        'store_id' => 1,
        ]);
        
        $data = $request->all();

    if($request->hasFile('image')){
        $file = $request->file('image');
        
        $data['image']= $file->store('/images',['disk' =>'uploads']);
    }
    
    $product = Product::create($data);

    $product->tags()->attach($this->getTags($request));
    
       return redirect()->route('admin.products.index')->with('success',"product ($product->name) created!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        /* $product = product::findOrFail($id);

        return view('admin.products.show',[
            'product' => $product,
           // 'categories'=> Category::all(),
        ]); */
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $product = product::findOrFail($id);
        $tags = $product->tags()->pluck('name')->toArray();
        return view('admin.products.edit',[
            'product' => $product,
            'categories'=> Category::all(),
            'tags'=> implode(',', $tags)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);
        $request->validate(product::validateRules());
        $data = $request->all();
        $previous=false;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $data['image']= $file->store('/images',['disk'=>'uploads']);
     
            $previous = $product->image;
        }
       $product->update($data);
       if($previous){
           Storage::disk('uploads')->delete($previous);
       }

       $product->tags()->sync($this->getTags($request));

       if($request->hasFile('gallery')){
        foreach ($request->file('gallery') as $file) {

            $image_path =  $file->store('/images',['disk'=>'uploads']);
            $product->images()->create([
                'image_path'=>$image_path,
            ]);
           }
       }
      
       return redirect()->route('admin.products.index')->with('success',"product ($product->name) updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product::findOrFail($id);
        $product->delete();
        if($product->image){
            Storage::disk('uploads')->delete($product->image);
        }
        return redirect()->route('admin.products.index')->with('success',"product ($product->name) deleted!");
    }


    protected function getTags(Request $request){
        $tag_ids = [];
        $tags = $request->post('tags');
        $tags = json_decode($tags);
        if(is_array($tags) && count($tags) > 0){
            $product_tags =[];
            foreach($tags as $tag){
                $tag_name = $tag->value;
                $tagModel = Tag::firstOrCreate([
                    'name' => $tag_name
                ],[
                    'slug' => Str::slug($tag_name)
                ]);
                $tag_ids[] = $tagModel->id;
            }
        }
        return $tag_ids;
    }
}

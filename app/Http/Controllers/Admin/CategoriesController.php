<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Rules\WordsFilter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class CategoriesController extends Controller
{
   public function index(Request $request){


    $categories = Category::when($request->name, function($query, $value) {
        $query->where(function($query) use ($value) {
            $query->where('categories.name', 'LIKE', "%{$value}%")
                ->orWhere('categories.description', 'LIKE', "%{$value}%");
        });
    })
    ->when($request->parent_id, function($query, $value) {
        $query->where('categories.parent_id', '=', $value);
    })
    /* ->leftJoin('categories as parents', 'parents.id', '=', 'categories.parent_id')
    ->select([
        'categories.*',
        'parents.name as parent_name'
    ]) */
    ->with('parent')
    ->get();

    $names = [];
    $data = [];
    foreach ($categories as $category) {
        if (in_array($category->name, $names)) {
            continue;
        }
        $data[] = $category;
        $names[] = $category->name;
    }

       $parents = Category::orderBy('name','asc')->get();
       return view('admin.categories.index',[
        'categories'=> $categories,
        'parents'=>$parents,
       ]);
   }
   
    public function create(){
        $title = "Add Category";
        $parents = Category::orderBy('name','asc')->get();
        $category = new Category();
      return view('admin.categories.create',compact('parents','title','category'));
    }

    public function store(CategoryRequest $request){
       
                    /*  $request->validate(
                            [
                                'name'=>'required|max:255|min:3|unique:categories,name',
                                'description'=>'nullable|min:3',
                                'parent_id'=>'nullable|exisits:categories,name',
                                'image'=>['nullable',
                                            'image',
                                            'max:1048576',
                                            'dimensions:min_width=300,min_height=300'],
                                'status'=>'required|in:active,inactive'
                            ]); 
                        */

         //   $this->validateRequest($request); // validate

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->save();

        session()->flash('success','Category added !!');
        
        return redirect()
                ->route('admin.categories.index');
    }

    public function show(){
        
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        /* if($category == null)
        {        
            abort(404);
        }   */ 
        
        $parents = Category::where('id', '<>', $id)
            ->orderBy('name', 'asc')
            ->get();


        return view('admin.categories.edit',[
            'id'=>$id,
            'parents'=>$parents,
            'category'=>$category,
        ]);
    }

    public function update(CategoryRequest $request, $id){
        $category = Category::findOrFail($id);

   //   $this->validateRequest($request,$id);
    
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->save();

        session()->flash('success','Category updated');
        return redirect()
            ->route('admin.categories.index');

    }

   public function delete($id){
    //1
    /* $category = Category::find($id);
    $category->delete();

    //2
    Category::where('id','=',$id) ->delete(); */
   
    //3
    Category::destroy($id);

    session()->flash('success','Category deleted');
    return redirect()
             ->route('admin.categories.index');
   }

   protected function validateRequest(Request $request, $id = 0){
  return  $request->validate(
        [
            'name'=>[
            'required',
             'max:255',
            'min:3',
             //"unique:categories,name,$id",
             //(new Unique('categories','name'))->ignore($id),
             Rule::unique('categories','name')->ignore($id)

            ],

            'description'=>['nullable',
            'min:5',
            //new WordsFilter(['laravel','php']),
            'filter:laravel,php'
            ],

            'parent_id'=>'nullable|exists:categories,id',
            'image'=>['nullable',
                        'image',
                        'max:1048576',
                        'dimensions:min_width=300,min_height=300'],
            'status'=>'required|in:active,inactive'
        ],
        //Messages
        [
            'name.required'=>'هذا الحقل مطلوب'
        ]);
   }
}

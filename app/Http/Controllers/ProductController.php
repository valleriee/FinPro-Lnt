<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function index(){
        $products = Product::All();
        return view('product.index', compact('products'));
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|min:5|max:80',
            'price'=>'required|integer',
            'stock'=>'required|integer',
            'image'=>'required',
            'category'=>'required'
        ]);

        $slug=Str::slug($request->name);
        $fileName = $request->file('image')->getClientOriginalName();
        if ($request->file('image')){
            $path = public_path().'/images';
            $upload = $request->file('image')->move($path, $fileName);
        }

        // Check if a category name is provided
        if ($request->filled('category')) {
        // Find or create the category
            $category = Category::firstOrCreate(['category_name' => $request->category]);

        // Associate the product with the obtained category ID
            // $product->category_id = $category->id;
        }

        // $product=Product::create([
        //     'name'=>$request->name,
        //     'price'=>$request->price,
        //     'stock'=>$request->stock,
        //     'image'=>$request->image,
        //     'category'=>$category->id,
        //     'image_path'=>'/images'.$fileName
        // ]);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $slug;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $category->id; // Set the category_id
        $product->image_path = '/images/' . $fileName;
        $product->save();

        return redirect()->route('product.index');
    }

    public function show($slug){
        $product=Product::where('slug',$slug)->first();

        if(is_null($product)){
            return view('product.index');
        }

        return view('product.show', compact('product'));
    }

}

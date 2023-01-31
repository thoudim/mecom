<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\MuliImg;
use App\Models\Product;
use App\Models\Brand;
use App\Models\User;
use Image;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function AllProduct(){
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    public function AddProduct() {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }

    public function StoreProduct(Request $request) {
        // if ($request->file('product_thambnail')) {
            $image = $request->file('product_thambnail');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/product_images/thambnail'.$name_gen);
            $save_url = 'upload/product_images/thambnail'.$name_gen;

            $product_id = Product::insertGetId([
                'brand_id' => $request->brand_id,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
                'product_code' => $request->product_code,
                'product_qty' => $request->product_qty,
                'product_tags' => $request->product_tags,
                'product_size' => $request->product_size,
                'product_color' => $request->product_color,
                'selling_price' => $request->selling_price,
                'discount_price' => $request->discount_price,
                'short_desc' => $request->short_desc,
                'long_desc' => $request->long_desc,                
                'product_thambnail' => $save_url,                
                'vendor_id' => $request->vendor_id,   
                'hot_deals' => $request->hot_deals,   
                'featured' => $request->featured,   
                'special_offer' => $request->special_offer,   
                'special_deals' => $request->special_deals,  
                'status' => 1,  
                'created_at' => Carbon::now(),  
            ]);

            // Multiple Images Upload
            $images = $request->file('multi_img');
            foreach ($images as $img) {
                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(800, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save('upload/product_images/multi_img'.$make_name);
                $uploadPath = 'upload/product_images/multi_img'.$make_name;

                MuliImg::insert([
                    'product_id' => $product_id,
                    'photo_name' => $uploadPath,
                    'created_at' => Carbon::now(),
                ]);
            } // End foreach
            // Multiple Images Upload End
            $notification = array(
                'message' => 'Product Insert Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        // } else {
        //     Category::create([
        //         'category_name' => $request->category_name,
        //         'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        //         'category_image' => '',
        //     ]);

        //     $notification = array(
        //         'message' => 'Category Insert Successfully',
        //         'alert-type' => 'success'
        //     );

        //     return redirect()->route('all.category')->with($notification);
        // }
    }
}

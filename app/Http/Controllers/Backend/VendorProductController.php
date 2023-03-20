<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\MultiImg;
use Auth;
use Image;
use Carbon\Carbon;

class VendorProductController extends Controller
{
    
    public function VendorAllProduct()
    {
        $id = Auth::user()->id;
        $products = Product::where('vendor_id', $id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all', compact('products'));
    }

    public function VendorAddProduct()
    {
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        return view('vendor.backend.product.vendor_product_add', compact('brands','categories','subcategory'));
    }

    public function VendorGetSubCategory($category_id)
    {
        $subCat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subCat);
    }

    public function VendorStoreProduct(Request $request) {

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('upload/product_images/Vthambnail'.$name_gen);
        $save_url = 'upload/product_images/Vthambnail'.$name_gen;

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
            'vendor_id' => Auth::user()->id,   
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
            })->save('upload/product_images/Vmulti_img'.$make_name);
            $uploadPath = 'upload/product_images/Vmulti_img'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'product_image' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        } // End foreach
        // Multiple Images Upload End
        $notification = array(
            'message' => 'Product Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);
    }

    public function VendorEditProduct($id)
    {
        $multi_image = MultiImg::where('product_id', $id)->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        return view('vendor.backend.product.vendor_product_edit', compact('brands','categories','subcategory', 'multi_image', 'products'));
    }

    public function VendorUpdateProduct (Request $request)
    {
        $product_id = $request->id;

        $old_image = Product::findOrFail($product_id);

        $oldImage = $request->old_img;

        $image = $request->file('product_thambnail');

        if (!empty($image)){
            
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(800,800)->save('upload/product_images/Vthambnail'.$name_gen);
            $save_url = 'upload/product_images/Vthambnail'.$name_gen;

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        } else {
            $save_url = $old_image->product_thambnail;
        }
        

        Product::findOrFail($product_id)->update([
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
            'hot_deals' => $request->hot_deals,   
            'featured' => $request->featured,   
            'special_offer' => $request->special_offer,   
            'special_deals' => $request->special_deals,  
            'status' => 1,  
            'updated_at' => Carbon::now(),  
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);
    }

    public function VendorUpdateProductMultiimage(Request $request) {

        $multi_img_id = $request->id;

        $oldImg = MultiImg::findOrFail($multi_img_id);

        $imgs = $request->multi_img;

        if(!empty($imgs)){
            foreach($imgs as $id => $img){
                $imgDel = MultiImg::findOrFail($id);
                unlink($imgDel->product_image);

                $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
                Image::make($img)->resize(800,800)->save('upload/product_images/Vmulti_img'.$make_name);
                $uploadPath = 'upload/product_images/Vmulti_img'.$make_name;

                MultiImg::where('id', $id)->update([
                    'product_image' => $uploadPath,
                    'updated_at' => Carbon::now(),
                ]);
            } // end foreach
        } else{
            MultiImg::where('id', $multi_img_id)->update([
                'product_image' => $oldImg->product_image,
            ]);
        }
        
        $notification = array(
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorMultiImageDelete($id){
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->product_image);

        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorProductInactive($id){

        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorProductActive($id){

        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function VendorProductDelete($id){

        $product = Product::findOrFail($id);
        unlink($product->product_thambnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();
        foreach($images as $img){
            unlink($img->product_image);
            MultiImg::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

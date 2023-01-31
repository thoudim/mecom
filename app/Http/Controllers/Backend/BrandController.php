<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Image;

class BrandController extends Controller
{
    public function AllBrand() {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    public function AddBrand() {
        return view('backend.brand.brand_add');
    }

    public function StoreBrand(Request $request) {
        
        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/brand_images/'.$name_gen);
            $save_url = 'upload/brand_images/'.$name_gen;

            Brand::create([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Insert Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::create([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => '',
            ]);

            $notification = array(
                'message' => 'Brand Insert Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function EditBrand($id) {
        $brand = Brand::findOrFail($id);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    public function UpdateBrand (Request $request) {
        $id = $request->id;
        $old_image = $request->old_image;
        
        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/brand_images/'.$name_gen);
            $save_url = 'upload/brand_images/'.$name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Brand::findOrFail($id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
                'brand_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Brand Update Successfully',
                'alert-type' => 'success'
            );

            // redirect('/admin/login')
            return redirect()->route('all.brand')->with($notification);
        } else {
            Brand::findOrFail($id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-', $request->brand_name)),
            ]);

            $notification = array(
                'message' => 'Brand Update Successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.brand')->with($notification);
        }
    }

    public function DeleteBrand($id) {
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        if ($img) {
            unlink($img);
        }
        

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}

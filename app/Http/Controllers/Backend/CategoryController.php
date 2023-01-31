<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Image;

class CategoryController extends Controller
{
    public function AllCategory() {
        $categorys = Category::latest()->get();
        return view('backend.category.category_all', compact('categorys'));
    }

    public function AddCategory() {
        return view('backend.category.category_add');
    }

    public function StoreCategory(Request $request) {
        
        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/category_images/'.$name_gen);
            $save_url = 'upload/category_images/'.$name_gen;

            Category::create([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Insert Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        } else {
            Category::create([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => '',
            ]);

            $notification = array(
                'message' => 'Category Insert Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.category')->with($notification);
        }
    }

    public function EditCategory($id) {
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }

    public function UpdateCategory (Request $request) {
        $id = $request->id;
        $old_image = $request->old_image;
        
        if ($request->file('category_image')) {
            $image = $request->file('category_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/category_images/'.$name_gen);
            $save_url = 'upload/category_images/'.$name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'category_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Update Successfully',
                'alert-type' => 'success'
            );

            // redirect('/admin/login')
            return redirect()->route('all.category')->with($notification);
        } else {
            Category::findOrFail($id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);

            $notification = array(
                'message' => 'Category Update Successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.category')->with($notification);
        }
    }

    public function DeleteCategory($id) {
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        if ($img) {
            unlink($img);
        }
        

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}

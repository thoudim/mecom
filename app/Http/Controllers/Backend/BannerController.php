<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Image;

class BannerController extends Controller
{
    public function AllBanner ()
    {
        $bannerAll = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('bannerAll'));
    }

    public function AddBanner() {
        return view('backend.banner.banner_add');
    }

    public function StoreBanner(Request $request) {
        
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(900, 900, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('upload/banner_image/'.$name_gen);
        $save_url = 'upload/banner_image/'.$name_gen;

        Banner::create([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Banner Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);
    }

    public function EditBanner($id) {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banner'));
    }

    public function UpdateBanner (Request $request) {
        $id = $request->id;
        $old_image = $request->old_image;
        
        if ($request->file('banner_image')) {
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(900, 000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/banner_image/'.$name_gen);
            $save_url = 'upload/banner_image/'.$name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Banner::findOrFail($id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Banner Update Successfully',
                'alert-type' => 'success'
            );

            // redirect('/admin/login')
            return redirect()->route('all.banner')->with($notification);
        } else {
            Banner::findOrFail($id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
            ]);

            $notification = array(
                'message' => 'Banner Update Successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.banner')->with($notification);
        }
    }

    public function DeleteBanner($id) {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        if ($img) {
            unlink($img);
        }
        

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}

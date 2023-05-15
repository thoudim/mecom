<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;

class SliderController extends Controller
{
    public function AllSlider ()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }

    public function AddSlider() {
        return view('backend.slider.slider_add');
    }

    public function StoreSlider(Request $request) {
        
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120, 120, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save('upload/slider_images/'.$name_gen);
        $save_url = 'upload/slider_images/'.$name_gen;

        Slider::create([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'Slider Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.slider')->with($notification);
    }

    public function EditSlider($id) {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function UpdateSlider (Request $request) {
        $id = $request->id;
        $old_image = $request->old_image;
        
        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save('upload/slider_images/'.$name_gen);
            $save_url = 'upload/slider_images/'.$name_gen;

            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Slider Update Successfully',
                'alert-type' => 'success'
            );

            // redirect('/admin/login')
            return redirect()->route('all.slider')->with($notification);
        } else {
            Slider::findOrFail($id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);

            $notification = array(
                'message' => 'Slider Update Successfully',
                'alert-type' => 'success'
            );
            
            return redirect()->route('all.slider')->with($notification);
        }
    }

    public function DeleteSlider($id) {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        if ($img) {
            unlink($img);
        }
        

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 
    }
}

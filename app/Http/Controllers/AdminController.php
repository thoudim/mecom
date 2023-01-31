<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard (){

        return view('admin.index');
    }

    public function AdminLogin () {
        return view('admin.admin_login');
    }

    public function AdminProfile () {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileStore (Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/').$data->photo);
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->photo = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Admin Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/admin/login')->with($notification);
    }

    public function AdminChangePassword () {
        return view('admin.admin_change_password');
    }

    public function AdminUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't Match!");
        }

        // Update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with("status", "Password Changed Successfully");
    }

    public function InactiveVendor() {
        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));
    }

    public function ActiveVendor() {
        $activeVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }

    public function InactiveVendorDetails($id) {
        $inActiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inActiveVendorDetails'));
    }


    public function ActiveVendorDetails($id) {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }

    public function InactivedVendor($id) {
        User::findOrFail($id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor Inactivated Successfully',
            'alert-type' => 'success'
        );
        
        // return redirect()->route('all.category')->with($notification);
        return redirect()->back()->with($notification);
    }

    public function ActivedVendor($id) {
        User::findOrFail($id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );
        
        // return redirect()->route('all.category')->with($notification);
        return redirect()->back()->with($notification);
    }

    public function ActiveVendorApprove(Request $request) {
        $id = $request->id;
        User::findOrFail($id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );
        
        return redirect('/inactive/vendor')->with($notification);
    }


    public function InactiveVendorApprove(Request $request) {
        $id = $request->id;
        User::findOrFail($id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor Inactivated Successfully',
            'alert-type' => 'success'
        );
        
        return redirect('/active/vendor')->with($notification);
    }
}

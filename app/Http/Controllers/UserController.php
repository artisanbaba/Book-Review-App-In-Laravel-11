<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    // Display the user's profile
    public function show()
    {
        $user = User::with('reviews')->find(Auth::user()->id);

        // dd($user->name);

        return view('account.user.profile', ['user' => $user]);
    }

    // Show the form for editing the user's profile
    public function edit()
    {
        $user = User::find(Auth::user()->id);

        // dd($user->name);

        return view('account.user.edit', ['user' => $user]);
    }

    // Update the user's profile
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id . ',id',
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('account.profile')->withInput()->withErrors($validator);
        }

        // update user info
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        // handle profile image upload
        if (!empty($request->image)) {

            // delete old images
            File::delete(public_path('uploads/profile/' . $user->image));
            File::delete(public_path('uploads/profile/thumb/' . $user->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            $image->move(public_path('uploads/profile'), $imageName);

            $user->image = $imageName;
            $user->save();

            // create new image instance
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/profile/' . $imageName));

            $img->cover(150, 150);

            $img->save(public_path('uploads/profile/thumb/' . $imageName));
        }

        return redirect()->route('account.showProfile')->with('success', 'Updated Successfully!');
    }

    public function changePassword()
    {
        return view('account.user.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([]);

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.changePassword')->withInput()->withErrors($validator);
        }

        // Check if the new password is the same as the current password
        if (Hash::check($request->new_password, Auth::user()->password)) {
            return back()->with('error', 'New password cannot be the same as the current password.');
        }

        // Check old password
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        // Save new password
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}

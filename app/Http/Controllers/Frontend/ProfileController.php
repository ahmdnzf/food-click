<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfilePasswordUpdateRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use App\Trait\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;

    function updateProfile(ProfileUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr('Profile Updated Successfully', 'success');

        return redirect()->back();

    }

    function updatePassword(ProfilePasswordUpdateRequest $request) : RedirectResponse {
        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        toastr('Password Updated Successfully', 'success');

        return redirect()->back();
    }

    function updateAvatar(Request $request) {
        /** Handle image file */
        $imagePath = $this->uploadImage($request, 'avatar');

        $user = Auth::user();
        $user->avatar = $imagePath;
        $user->save();

        return response(['status' => 'success', 'message' => 'Avatar Updated Successfully']);
    }
}

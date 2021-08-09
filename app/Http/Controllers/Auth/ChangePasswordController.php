<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\Admin\UserResource;
use Gate;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ChangePasswordController extends Controller
{
    public function edit()
    {
        abort_if(Gate::denies('profile_password_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('auth.passwords.edit');
    }

    public function update(UpdatePasswordRequest $request)
    {
        if (!Hash::check($request->input('old_password'), auth()->user()->password)) {
            return response()
                ->json(['message' => 'Old password is incorrect'])
                ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (Hash::check($request->input('password'), auth()->user()->password)) {
            return response()
                ->json(['message' => 'New password cannot be the same as old password'])
                ->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        auth()->user()->update($request->validated());

        if ($request->ajax()) {
            return new UserResource(auth()->user());
        }

        return redirect()->route('profile.password.edit')->with('message', __('global.change_password_success'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        if ($request->ajax()) {
            return new UserResource($user);
        }

        return redirect()->route('profile.password.edit')->with('message', __('global.update_profile_success'));
    }

    public function destroy()
    {
        $user = auth()->user();

        $user->update([
            'email' => time() . '_' . $user->email,
        ]);

        $user->delete();

        return redirect()->route('login')->with('message', __('global.delete_account_success'));
    }
}

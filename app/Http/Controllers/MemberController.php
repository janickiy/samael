<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\Auth::user()->role->name == 'Admin') {
            return redirect('admin/dashboard');
        }
        return view('member.home');
    }

    /**
     * @return $this
     */
    public function profile()
    {
        $user = \Auth::user();
        return view('member.profile')->with(compact('user'));
    }

    /**
     * @return $this
     */
    public function editProfile()
    {
        $user = \Auth::user();
        $job_titles = getSetting('JOB_TITLES');

        return view('member.edit_profile')->with(compact('user', 'job_titles'));
    }

    /**
     * @param ProfileRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $user = \Auth::user();

        $user->name = $request->input('name');
        $user->mobile = $request->input('mobile');
        $user->job_title = $request->input('job_title');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        if ($request->hasFile('avatar')) {

            $destinationPath = public_path() . '/uploads/avatars';

            if ($user->avatar != "uploads/avatars/avatar.png") {
                @unlink($user->avatar);
            }

            $avatar = hash('sha256', mt_rand()) . '.' . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move($destinationPath, $avatar);

            \Image::make(asset('uploads/avatars/' . $avatar))->fit(300, null, null, 'top-left')->save('uploads/avatars/' . $avatar);

            $user->avatar = $avatar;
        }

        $user->save();

        return redirect('member/profile')->with('success', 'Your Profile Updated Successfully');
    }
}

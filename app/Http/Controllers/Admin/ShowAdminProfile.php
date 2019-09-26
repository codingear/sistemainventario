<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowAdminProfile extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return View
     */
    public function __invoke()
    {
        return view('admin.administrators.profile');
        // return view('user.profile', ['user' => User::findOrFail($id)]);
    }
}

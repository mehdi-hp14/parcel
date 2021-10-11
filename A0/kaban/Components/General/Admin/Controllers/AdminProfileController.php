<?php

namespace Kaban\Components\General\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminProfileController extends Controller
{
    public function adminProfilePage()
    {
        $admin = Auth::guard('adminGuard')->user();

        return view('GeneralAdmin::adminProfile',compact('admin'));
    }

    public function update(Request $request)
    {

        $admin = Auth::guard('adminGuard')->user();

        $request->validate([
            'name'=>'required|min:2',
            'email'=>[
                'required',
                'email',
                Rule::unique('admins')->ignore($admin->id)
            ],
        ]);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return back();
     }

}

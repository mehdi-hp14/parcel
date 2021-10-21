<?php

namespace Kaban\Components\General\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Kaban\General\Enums\EAdminRank;
use Kaban\Models\Admin;

class AdminProfileController extends Controller
{
    public function adminProfilePage()
    {
        $admin = Auth::guard('adminGuard')->user();

        return view('GeneralAdmin::adminProfile', compact('admin'));
    }

    public function otherAdminProfilePage($id)
    {
//        $admin = Auth::guard('adminGuard')->user();
        $admin = Admin::find($id);

        return view('GeneralAdmin::adminProfile', compact('admin'));
    }

    public function update(Request $request)
    {

        $user = Auth::guard('adminGuard')->user();

        if ($user->rank >= EAdminRank::superAdmin && $request->target_admin_id != $user->id) {


            $admin = Admin::find($request->target_admin_id);
            if ($user->rank <= $admin->rank) {
                return redirect(route('admin.list'));
            }
        } else {
            $admin = $user;
        }

        $request->validate([
            'name' => 'required|min:2',
            'email' => [
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

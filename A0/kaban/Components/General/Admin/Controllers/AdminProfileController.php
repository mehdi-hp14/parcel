<?php

namespace Kaban\Components\General\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Kaban\General\Enums\EAdminRank;
use Kaban\General\Enums\EAdminStatus;
use Kaban\Models\Admin;
use Kaban\Models\User;

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
//        dd(\Kaban\General\Enums\EAdminRank::optionize(true,'admin.rank.',(int)$admin->rank));

        $superAdmin = true;

        return view('GeneralAdmin::adminProfile', compact('admin', 'superAdmin'));
    }

    public function update(Request $request)
    {

        $user = Auth::guard('adminGuard')->user();

        if ($user->rank >= EAdminRank::superAdmin && $request->target_admin_id != $user->id) {


            $admin = Admin::find($request->target_admin_id);
//            if ($user->rank <= $admin->rank) {
            //super admin should not change other super admins
//                return redirect(route('admin.list'));
//            }
        } else {
            $admin = clone $user;
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
        $admin->status = $request->status;

        if($request->rank < $user->rank && $user->id === $admin->id){
            session()->flash('danger-status', 'you can\'t diminish your role');
            $error = true;
        }
        if($admin->id  == $user->id && $request->status ==EAdminStatus::disabled ){
            session()->flash('danger-status', 'you can\'t disable your account');
            $error = true;
        }
        if(isset($error)){
            return back();
        }
        $admin->rank = $request->rank;
        $admin->save();
        session()->flash('success-status', 'successfully updated');
        return back();
    }

}

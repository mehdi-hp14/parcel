<?php

namespace Kaban\Components\General\Admin\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kaban\General\Enums\EAdminRank;
use Kaban\Models\Admin;

class AdminListController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    public function list($admins = null)
    {
        if (!$admins) {
            $admins = Admin::paginate(10);
        }
        return view('GeneralAdmin::list', compact('admins'));
    }

    public function search(Request $request)
    {
        $admins = Admin::
        when($request->filled('name'), function ($q) use ($request) {
            $q->where('name', 'like', "%$request->name%");
        })
            ->when($request->filled('email'), function ($q) use ($request) {
                $q->where('email', 'like', "%$request->email%");
            })
            ->when($request->filled('id'), function ($q) use ($request) {
                $q->where('id', $request->id);
            })
            ->paginate(10);

        return $this->list($admins);
    }

    public function destroy($id)
    {
        $targetAdmin = Admin::find($id);

        $user = auth()->user();

        if ($user->id != $targetAdmin->id) {
            $targetAdmin->delete();
        }

        return back();
    }
}

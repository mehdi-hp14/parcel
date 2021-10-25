<?php

namespace Kaban\Components\General\Agent\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AgentProfileController extends Controller
{
    public function agentProfilePage()
    {
        $agent = Auth::guard('agentGuard')->user();

        return view('GeneralAgent::agentProfile',compact('agent'));
    }

    public function update(Request $request)
    {

        $agent = Auth::guard('agentGuard')->user();

        $request->validate([
            'name'=>'required|min:2',
            'email'=>[
                'required',
                'email',
                Rule::unique('agents')->ignore($agent->id)
            ],
        ]);
        $agent->fname = $request->name;
        $agent->email = $request->email;
        $agent->save();

        return back();
     }

}

<?php

namespace Kaban\Components\General\MailConfig\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Kaban\Models\Admin;
use Kaban\Models\MailConfig;

class MailConfigController extends Controller
{
    const cache_key = 'mailConfig';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailConfigs = MailConfig::paginate(10);

        return view('GeneralMailConfig::index', compact('mailConfigs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('GeneralMailConfig::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MailConfig::create($request->all());

        return redirect(route('mail-config.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = MailConfig::findOrFail($id);


        return view('GeneralMailConfig::edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mailConfig = MailConfig::where('id', $id)->first();

        $mailConfig->update([
            'driver' => $request->driver,
            'host' => $request->host,
            'port' => $request->port,
            'username' => $request->username,
            'password' => $request->password,
            'encryption' => $request->encryption,
            'from_address' => $request->from_address,
            'to_address' => $request->to_address
        ]);

        if ($mailConfig->active) {
            Cache::put(self::cache_key, $mailConfig);
        }
        return redirect(route('mail-config.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MailConfig::where('id', $id)->delete();

        return back();
    }

    /**
     * Pick As Active the given mailConfig
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function pickAsActive(MailConfig $mailConfig)
    {
        MailConfig::query()->update(['active' => 0]);

        $mailConfig->active = 1;

        $mailConfig->save();

        if ($mailConfig->active) {
            Cache::put(self::cache_key, $mailConfig);
        }

        return redirect(route('mail-config.index'));
    }
}

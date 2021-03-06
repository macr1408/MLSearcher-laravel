<?php

namespace App\Http\Controllers\Users;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userSettings = UserSettings::where('user_id', '=', Auth::id())->first();
        return view('user.settings', ['user' => $userSettings]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserSettings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(UserSettings $settings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserSettings  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSettings $settings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = $request->input();
        if (empty($settings['allowed-locations'])) {
            $locations = '';
        } else {
            $locations = explode(',', $settings['allowed-locations']);
            $locations = array_map(function ($elem) {
                return trim(strtolower($elem));
            }, $locations);
            $locations = implode(',', $locations);
        }
        UserSettings::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'allowed-locations' => $locations
            ]
        );
        Helper::flash_success('Configuración guardada correctamente');
        $userSettings = UserSettings::where('user_id', '=', Auth::id())->firstOrFail();
        return view('user.settings', ['user' => $userSettings]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserSettings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSettings $settings)
    {
        //
    }
}

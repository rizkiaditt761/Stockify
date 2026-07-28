<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Setting\SettingService;

class SettingController extends Controller
{

    protected $settingService;


    public function __construct(
        SettingService $settingService
    )
    {
        $this->settingService = $settingService;
    }



    /**
     * Halaman Pengaturan
     */
    public function index()
    {

        $setting = $this->settingService
            ->getSetting();


        return view(
            'pages.settings.index',
            compact('setting')
        );

    }



    /**
     * Update Pengaturan
     */
    public function update(Request $request)
    {


        $data = $request->validate([


            'app_name'
                => 'required|string|max:50',


            'description'
                => 'nullable|string',


            'footer_text'
                => 'nullable|string|max:100',


            'logo'
                => 'nullable|image|max:2048',


            'favicon'
                => 'nullable|image|max:1024',


        ]);



        $this->settingService
            ->updateSetting($data);



        return back()
            ->with(
                'status',
                'setting-updated'
            );

    }

}
<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{   
    public function index(){
        $settings = Setting::all();
        $options = [];
        foreach($settings as $setting){
            $options[$setting->key] = $setting->value;
        }
        $option = collect($options);
        return view('admin.settings.index', compact('option'));
    }

    public function save(Request $request){
        $settings = collect($request->except(['_token', 'save_settings']));

        $settings->map(function($option, $key)  {

            if($option instanceof UploadedFile){
                $file = $option;
                $fileName = Str::random(25). time().$file->getClientOriginalName();
                $option = $file->storeAs('settings', $fileName, 'public');                
             }

            Setting::updateOrCreate(['key' => $key], [
                'key' => $key, // logo
                'value' => $option, 
            ]);
        });

        return back()->with(['status' => 'success', 'message' => 'Setting Option has been created successfully.']);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        $valid = Validator::make( $request->all(), [
                "first_name" => ['required', 'string', 'max:70'],
                "last_name"  => ['required', 'string', 'max:70'],
                "username"   => ['required', 'max:50', 'unique:users'],
                "email"      => ['required', 'max:70', 'unique:users'],
                "mobile"     => ['nullable', 'max:15', 'unique:users'],
                "password"   => ['required', 'max:170'],
                "user_type"  => ['required', 'string', 'max:20'],
                "birthdate"  => ['nullable', 'date'],
                "gender"     => ['nullable', 'string', 'max:11'],
                "country"    => ['nullable', 'string', 'max:30', 'required_with:city'],
                "city"       => ['nullable', 'string', 'max:30', 'required_with:country'],
                "address"    => ['nullable'],
        ]);

        if( $valid->fails() ){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $user = new User();

        $user->first_name = $request->first_name ?? '';
        $user->last_name = $request->last_name ?? '';
        $user->name = $request->first_name .' '. $request->last_name;
        $user->username = $request->username ?? '';

        $user->email = $request->email ?? '';
        $user->mobile = $request->mobile ?? '';
        $user->password = bcrypt($request->password) ?? '';

        $user->user_type = $request->user_type ?? '';
        $user->birthdate = Carbon::create($request->birthdate)->format('Y-m-d') ?? '';
        $user->gender = $request->gender ?? '';

        $user->country = $request->country ?? '';
        $user->city = $request->city ?? '';
        $user->address = $request->address ?? '';

        if($user->save()){
            return redirect()->route('admin.users')->with(['status' => 'success', 'message' => 'User has been created successfully']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'User has not been created successfully']);
        }

    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }
    
    public function profile($id){
        return view('admin.users.profile');
    }

    public function update(Request $request, $id){

        $valid = Validator::make( $request->all(), [
            "first_name" => ['required', 'string', 'max:70'],
            "last_name"  => ['required', 'string', 'max:70'],
            "username"   => ['required', 'max:50'],
            "email"      => ['required', 'max:70'],
            "mobile"     => ['nullable', 'max:15'],
            "password"   => ['required', 'max:170'],
            "user_type"  => ['required', 'string', 'max:20'],
            "birthdate"  => ['nullable', 'date'],
            "gender"     => ['nullable', 'string', 'max:11'],
            "profile_pic" => ['nullable', 'image', 'max:1024', 'dimensions:max_height=500,max_width=500'],
            "country"    => ['nullable', 'string', 'max:30', 'required_with:city'],
            "city"       => ['nullable', 'string', 'max:30', 'required_with:country'],
            "address"    => ['nullable'],
        ]);

        if( $valid->fails() ){
            return redirect()->back()->withErrors($valid)->withInput();
        }
        
        $user = User::findOrFail($id);

        $user->first_name = $request->first_name ?? '';
        $user->last_name = $request->last_name ?? '';
        $user->name = $request->first_name .' '. $request->last_name;
        $user->username = $request->username ?? '';

        $user->email = $request->email ?? '';
        $user->mobile = $request->mobile ?? '';
        $user->password = bcrypt($request->password) ?? '';

        $user->user_type = $request->user_type ?? '';
        $user->birthdate = Carbon::create($request->birthdate)->format('Y-m-d') ?? '';
        $user->gender = $request->gender ?? '';

        $user->country = $request->country ?? '';
        $user->city = $request->city ?? '';
        $user->address = $request->address ?? '';

        if($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic');
            $fileName = Str::random(25). time().$file->getClientOriginalName();
            $profile_pic = $file->storeAs('profile', $fileName, 'public');

            if(!empty(Auth::user()->profile_pic)){
                Storage::disk('public')->delete(Auth::user()->profile_pic);
            }
            
            $user->profile_pic = $profile_pic;
        }

        if($user->save()){
            return redirect()->route('admin.users')->with(['status' => 'success', 'message' => 'User has been updated successfully']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'User has not been updated successfully']);
        }

    }

    public function delete($id){
        if(User::findOrFail($id)->delete()){
            return redirect()->route('admin.users')->with(['status' => 'success', 'message' => 'User has been Deleted successfully']);
        }else{
            return redirect()->back()->with(['status' => 'error', 'message' => 'User has not been deleted successfully']);
        }
    }

}
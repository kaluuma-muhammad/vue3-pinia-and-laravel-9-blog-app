<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Auth;
use Carbon\Carbon;


//traits
use App\Traits\Validatormsgs;
use App\Traits\filestorage;
use App\Traits\returnmessages;


//models
use App\Models\User;
use App\Models\Userlocation;
use App\Models\Userdevice;
use App\Models\Userprofile;

class AuthController extends Controller
{
    use Validatormsgs, filestorage, returnmessages;

    public function login(Request $request){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'contact' => 'required',
            'password' => ['required'],
        ], $messages);

        if($validator->fails()){
            return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            return $this->login_user($request);
        }
    }

    public function register(Request $request){
        $messages =  $this->valmsgs();
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required'],
            'contact' => ['required'],
            'password' => ['required'],
        ], $messages);

        if($validator->fails()){
            return response()->json([
                'msg'=> $validator->errors(),
                'status' => 400
            ], 400);
        }else{
            $requestData = $request->All();
            $newuser = new User;
            $newuser->name = $request->name;
            $newuser->email = $request->email;
            $newuser->contact = $request->contact;
            $newuser->slug = str::slug($request->name).time();
            $newuser->password = Hash::make($requestData['password']);
            $newuser->save();
            if($newuser->save()){
                $profile = new Userprofile;
                $profile->user_id = $newuser->id;
                $profile->image_url = env('APP_URL').'/uploads/users/profile/userimage.png';
                $profile->save();
                return $this->login_user($request); 
            }else{
                return $this->returnerror();
            }             
        }
    }

    public function login_user($request){   
        if(!Auth::check()){
            $user = User::where('contact', $request->contact)->first();
            if($user){
                $username = $user->name; 
            }else{
                return response()->json([
                    'msg'=> 'Account with contact entered does not exist',
                    'status' => 401
                ], 401);
            }
        }
           
        if(!Auth::attempt(['name' => $username , 'password' => $request->password])){
            return response()->json([
                'msg'=> 'Either contact cr password is incorrect',
                'status' => 401
            ], 401);
        }

        $user = $request->user();
        if($user){
            if(count($user->locations)){
                $keep = Userlocation::where('user_id', $user->id)->latest()->take(10)->pluck('id');
                Userlocation::where('user_id', $user->id)->whereNotIn('id', $keep)->delete();
            }
            
            $ip = request()->header('X-Forwarded-For');
            $data = \Location::get($ip);
            $location = new Userlocation;
            $location->user_id = $user->id;
            $location->location = json_encode($data);
            $location->save();  

            if(count($user->devices)){
                $keep = Userdevice::where('user_id', $user->id)->latest()->take(10)->pluck('id');
                Userdevice::where('user_id', $user->id)->whereNotIn('id', $keep)->delete();
            }
            
            $data = request()->userAgent();
            $device = new Userdevice;
            $device->user_id = $user->id;
            $device->useragent = json_encode($data);
            $device->save();
        }
      
        if($user->role == 'admin'){
            $tokenData = $user->createToken('Admin Access',['full_access']);
        }else{
            $tokenData = $user->createToken('User Access',['user_access']);
        }
        
        $token = $tokenData->token;
        if($request->remember_me){
            $token->expires_at = Carbon::now()->addWeeks(3);
        }else{
            $token->expires_at = Carbon::now()->addDays(1);
        }
        $token->save();

        if($token->save()){
            $authuser = User::with('unreadNotifications')->find($user->id);
            $location = Userlocation::where('user_id',$authuser->id)->latest()->first();

            return response()->json([
                'res'=> $authuser,
                'location' => json_decode($location->location),
                'auth_token' => $tokenData,
                'token_type' => 'Bearer',
                'token_scope' => $tokenData->token->scopes[0],
                'expires_at' =>  Carbon::parse($tokenData->token->expires_at),
                'msg'=> 'Welcome ',
                'status' => 201
            ], 201);
        }
    }

    public function log_out_user(Request $request){
        $request->user()->token()->revoke();
        return response()->json([
            'msg'=> 'You have been successfully Logout out',
            'status_code' => 200
        ], 200);
    }

    public function auth_user(){
        $user = Auth::user();
        $token = $tokenData->token;
        $token->save();

        if($token->save()){
         
        $authuser = User::with(['unreadNotifications','profile','finance'])->find($user->id);
        $location = Userlocation::where('user_id',$authuser->id)->latest()->first();
            return response()->json([
                'res'=> $authuser,
                'location' => json_decode($location->location),
                'auth_token' => $tokenData,
                'token_type' => 'Bearer',
                'token_scope' => $tokenData->token->scopes[0],
                'expires_at' =>  Carbon::parse($tokenData->token->expires_at),
                'msg'=> 'Welcome ',
                'status' => 201
            ], 201);
        }
    }
}
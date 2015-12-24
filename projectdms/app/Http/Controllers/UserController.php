<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use Crypt;
use Route;
use Response;
use Redirect;
use Session;
use DB;

class UserController extends Controller
{
    public function logIn(Request $request){
        $username = $request->get("email");
        $password = $request->get("password");
        
        $users = Users::where('username', $username)->get();
        $user = $users[0];
        
        if(!empty($user)){
            $decryptedPassword = Crypt::decrypt($user->password);
            if($decryptedPassword == $password){
                
                return redirect()->action('CRMController@homeView', ["session"=>Crypt::encrypt($user->id . ":" . $user->fullname)]);
            }
        }
        
        return redirect('/?login=err');
    }
    
    public function logOut(Request $request){
    
        return redirect('/');
    }
    
    public function registerUser(Request $request){
        $fullname = $request->get("fullname");
        $username = $request->get("email");
        $password = $request->get("password");
        
        $user = new Users;
        $user->fullname = $fullname;
        $user->username = $username;
        $user->password = Crypt::encrypt($password);
        
        $user->save();
        
        return redirect('/');
    }
}

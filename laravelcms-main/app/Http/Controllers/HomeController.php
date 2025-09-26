<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\user;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
       
        if(Auth::id()){

            $usertype = Auth()->user()->usertype; 
            $username = Auth()->user()->name; 
            $useremail = Auth()->user()->email;            
            if($usertype=="user"){
                return view("userpanel.user.index",compact(array('usertype','username','useremail')));
            }
            else if($usertype=="useradmin"){
                return view("userpanel.super.index",compact(array('usertype','username','useremail')));
            }
            else{
                return view("userpanel.admin.index",compact(array('usertype','username','useremail')));
            }
            
        }
        else{
            return view("welcome");
        }
    }


    public function profileUpdateform(){
        $usertype = Auth()->user()->usertype; 
        $username = Auth()->user()->name; 
        $useremail = Auth()->user()->email;      
         return view("userpanel.user.profileUpdateform",compact(array('usertype','username','useremail')));
        

    }

    public function profileUpdate(Request $request){
     
        $request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255',
            'avatar' => 'required|image'
        ]);


        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);
  
        Auth()->user()->update(['avatar'=>$avatarName]);
    
     
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];       
        $user->save();
        return back()->with('success','Profile Updated');
    }

    public function getalluser(){

        $userlist = User::all();
        return view("userpanel.user.alluser",compact(array('userlist')));
    }
}

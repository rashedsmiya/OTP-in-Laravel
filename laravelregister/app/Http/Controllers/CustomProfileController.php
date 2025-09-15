<?php

    namespace App\Http\Controllers;
    
     

    use App\Models\User;
    use Illuminate\Container\Attributes\Auth;
    use Illuminate\Http\Request;

    class CustomProfileController extends Controller
    {
        public function store(Request $request) 
        {
            $enable_two_factor_auth = $request->enable_two_factor_auth;

            $user = User::find($request->user()->id);
            $user->enable_two_factor_auth = $enable_two_factor_auth ? false: true;
            $user->save();

            return redirect()->back(); 
        }
    }

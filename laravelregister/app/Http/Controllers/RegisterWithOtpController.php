<?php

    namespace App\Http\Controllers;

    use App\Models\EmailOtp;
    use Carbon\Carbon;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Validation\Rules\Password;
    use App\Mail\EmailOtpMail; 

    class RegisterWithOtpController extends Controller
    {
       
        public function create()
        {
            return view('auth_otp.register');
        }

        public function store(Request $request)
        {   
            $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    'password' => ['required', 'confirmed', Password::defaults()],
                ]);

                $otp = rand(100000, 999999);

                EmailOtp::updateOrCreate(['email' => $request->email], [
                    'email' => $request->email,
                    'otp' => $otp,
                    'expired_at' => Carbon::now()->addMinute(10)
                ]); 

                Mail::to($request->email)->send(new EmailOtpMail($otp));
                

                // send otp 
                return redirect()->route('verify.otp');
        }   

        public function verifyOtp()
        {
             //
        }
}

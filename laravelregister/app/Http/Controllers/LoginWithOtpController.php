<?php

    namespace App\Http\Controllers;

    use Carbon\Carbon;
    use App\Models\User;
    use App\Http\Controllers\Controller;
    use App\Mail\EmailOtpMail;
    use Illuminate\Http\Response;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Auth;

    class LoginWithOtpController extends Controller
    {
        public function create(){
            return view('auth_otp.login');
        }

        public function store(Request $request){
            $request->validate([
                    
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            
            ]);

            $user = User::where('email', $request->email)->first();

            if($user->enable_two_factor_auth){

                $otp = rand(100000, 999999);

                EmailOtp::updateOrCreate(['email' => $request->email], [
                    'email' => $request->email,
                    'otp' => $otp,
                    'expired_at' => Carbon::now()->addMinute(10)
                ]); 
            
                Mail::to($request->email)->send(new EmailOtpMail($otp));

                    $request->session()->put('login_email', $request->email); 
                    $request->session()->put('login_password', $request->password);

                    return redirect()->route('verify.otp.login');
                
            }else{
                if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->back()->withInput()->with(['message' => 'Invalid Email or ']);
              }

              return redirect(route('dashboard', absolute: false));

            }
    
        }

        public function verifyOtp(){

            return view('auth_otp.email_otp_login_verify');
        }

        public function verifyOtpStore(Request $request){
            $request->validate([
                'otp' => ['required', 'string', 'size:6'],
            ]);

            $email = $request->session()->get('login_email');  
            $password = $request->session()->get('login_password');

             $emailOtp = EmailOtp::where('email', $email)
               ->where('otp', $request->otp)
               ->where('expired_at', '>=', Carbon::now())
               ->first();

               if(!$emailOtp){
                return redirect()->back()->withInput()->with(['message' => 'Invalid OTP or OTP has been expired',]);
               }

              if(!Auth::attempt(['email' => $email, 'password' => $password])){
                return redirect()->back()->withInput()->with(['message' => 'Invalid Email or ']);
              }

              $emailOtp->delete();

              $request->session()->forget('register_email');
              $request->session()->forget('register_password');

              return redirect(route('dashboard', absolute: false));
        }
    }

<?php

    namespace App\Http\Controllers; 
    use App\Models\EmailOtp; 
    use Carbon\Carbon; 
    use App\Models\User; 
    use Illuminate\Http\Request; 
    use Illuminate\Support\Facades\Mail; 
    use Illuminate\Support\Facades\Hash; 
    use Illuminate\Validation\Rules\Password; 
    use App\Mail\EmailOtpMail; 
    use Illuminate\Support\Facades\Auth;

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

                $request->session()->put('register_email', $request->email);
                $request->session()->put('register_name', $request->name);
                $request->session()->put('register_password', Hash::make($request->password));

                // send otp 
                return redirect()->route('verify.otp');
        }   

        public function verifyOtp()
        {
            return view('auth_otp.email_otp_verify');
        }

        public function verifyOtpStore(Request $request)
        {
           $request->validate([
                    'otp' => ['required', 'string', 'size:6'], 
                ]);

                $email = $request->session()->get('register_email');
                $name = $request->session()->get('register_name');
                $password = $request->session()->get('register_password');

              $emailOtp = EmailOtp::where('email', $email)
               ->where('otp', $request->otp)
               ->where('expired_at', '>=', Carbon::now())
               ->first();

               if(!$emailOtp){
                return redirect()->back()->withInput()->with(['message' => 'Invalid OTP or OTP has been expired',]);
               }
               
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => $password,
                ]);

                $emailOtp->delete();

                $request->session()->forget('register_email');
                $request->session()->forget('register_name');
                $request->session()->forget('register_password');

                Auth::login($user);
                
                return redirect(route('dashboard', absolute: false)); 
                
            }
    }   
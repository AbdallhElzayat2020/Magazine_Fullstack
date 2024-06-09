<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\HandelLoginRequest;
    use App\Http\Requests\SendResetLinkRequest;
    use App\Models\Admin;
    use App\Models\Adminller;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Requestuest;
    use App\Mail\AdminSendResetLinkMail;
    use Illuminate\Support\Facades\Mail;
    use App\Http\Controllers\Controlleruest;
    use App\Mail\AdminSendResetLinkMailuest;
    use Illuminate\Support\Facades\MailMail;
    use Illuminate\Http\RedirectResponsedmin;
    use App\Http\Requests\HandelLoginRequestonse;
    use App\Http\Requests\SendResetLinkRequestuest;
    use App\Http\Requests\AdminResetPasswordRequest;
    use App\Http\Requests\AdminResetPasswordRequestMail;

    class AdminAuthController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function login()
        {
            return view("admin.auth.login");
        }

        public function handleLogin( HandelLoginRequest $request )
        {
            $request->authenticate();

            return redirect()->route("admin.dashboard");
        }

        public function logout( Request $request ): RedirectResponse
        {
            Auth::guard('admin')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()->route('admin.login');
        }

        public function forgotPassword()
        {
            return view('admin.auth.forgot-password');
        }

        public function sendResetLink( SendResetLinkRequest $request )
        {
//            dd($request->all());
            $token = \Str::random(64);

            $admin = Admin::where('email' , $request->email)->first();

            $admin->remember_token = $token;

            $admin->save();

            Mail::to($request->email)->send(new AdminSendResetLinkMail($token , $request->email));

            return redirect()->back()->with('success' , __('A mail Has Been Send To Your Email Please Check'));
        }

        public function resetPassword( $token )
        {
            return view('admin.auth.reset-password' , compact('token'));
        }

        public function handleResetPassword( AdminResetPasswordRequest $request )
        {
//            $admin = Admin::where([ 'remember_token' => $request->token ]);
            $admin = Admin::where([ 'email' => $request->email , 'remember_token' => $request->token ])->first();

            if ( !$admin) {
//                return redirect()->route("admin.login")->with("error" , "");
                return back()->with("error" , __('token is invalid'));

                $admin->password = bcrypt($request->password);

                $admin->remember_token = null;

                $admin->save();

                return redirect()->route("admin.login")->with("success" , __('Password Has Been Changed'));
            }
        }
    }

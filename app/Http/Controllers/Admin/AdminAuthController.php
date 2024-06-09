<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\HandelLoginRequest;
    use App\Http\Requests\SendResetLinkRequest;
    use App\Mail\AdminSendResetLinkMail;
    use App\Models\Admin;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Mail;


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

            Mail::to($request->email)->send(new AdminSendResetLinkMail($token));
            return redirect()->back()->with('success' , 'A mail Has Been Send To Your Email Please Check');
        }

        public function resetPassword()
        {

        }
    }

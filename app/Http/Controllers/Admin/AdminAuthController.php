<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\HandelLoginRequest;
    use App\Models\admin;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

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

            return redirect()->route('admin.login')->with('success' , 'Logout successfully');
        }

    }

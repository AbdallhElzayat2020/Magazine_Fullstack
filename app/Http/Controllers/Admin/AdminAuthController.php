<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\HandelLoginRequest;
    use App\Models\admin;
    use Illuminate\Http\Request;

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
    }

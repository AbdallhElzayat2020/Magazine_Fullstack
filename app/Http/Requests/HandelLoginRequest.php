<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Validation\ValidationException;

    class HandelLoginRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
         */
        public function rules( Request $request ): array
        {
            return [
                $request->validate([
                    'email' => [ 'required' , 'email' , 'max:255' ] ,
                    'password' => [ 'required' ] ,
                ]) ,
            ];
        }
        public function authenticate(): void
        {
            if ( !Auth::guard('admin')->attempt($this->only('email' , 'password') , $this->boolean('remember'))) {
                throw ValidationException::withMessages([
                    'email' => trans('auth.failed') ,
                ]);
            }
        }

//        if you want to Customize your error messages
//        public function messages(): array
//        {
//            return [
//                'email.required' => 'The Email is required' ,
//                'password.required' => 'The message is required' ,
//            ];
//        }
    }

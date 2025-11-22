<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Crypt;
use Laravel\Socialite\Facades\Socialite;

use App\Models\user;
use App\Models\company;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }// end method

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember_token' => ['nullable'],
        ]);

        if (Auth::attempt($credentials)) 
        {
            user::updateLastLogin($credentials['email']);

            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return redirect()->back()->with('error','The provided credentials do not match our records.')->onlyInput('email');

    }//end method authenticate

    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        return redirect(route('auth'));

    }// end method logout

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }//end method forgot password

    public function forgotPasswordEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );
     
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['success' => __($status)])
                    : back()->withErrors(['email' => __($status)]);

    }//end method forgot password email

    public function reset(string $token,Request $request)
    {   
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        return view('auth.reset-forgot-password', ['token' => $token,'email' =>$validated['email']]);
    }//end method reset

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('auth')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }//end method reset password

    public function githubRedirect()
    {
        return Socialite::driver('github')->redirect();
    }//end method github redirect

    public function githubCallBack()
    {
        $githubUser = Socialite::driver('github')->user();
    
        $existingUser = User::where('email', $githubUser->email)->first();
        //dd($existingUser->email);

        if ($existingUser) {

            $existingUser->github_id = $githubUser->id;
            $existingUser->github_token = $githubUser->token;
            $existingUser->save();

            // Log the user in if they already exist
            Auth::login($existingUser);
            
                return redirect('/dashboard');
        } else{

        }
        return redirect(route('auth'))->with('error','accout or password is not exit');

    }//end method github callback

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }//end method google redirect

    public function googleCallBack()
    {
        $googleUser = Socialite::driver('google')->user();
    
        $existingUser = User::where('email', $googleUser->email)->first();
        //dd($existingUser->email);

        if ($existingUser) {

            $existingUser->google_id = $googleUser->id;
            $existingUser->google_token = $googleUser->token;
            $existingUser->save();

            // Log the user in if they already exist
            Auth::login($existingUser);
            
                return redirect('/dashboard');
        } else{

        }
        return redirect(route('auth'))->with('error','accout or password is not exit');

    }//end method google callback

    public function linkedinRedirect()
    {
        return Socialite::driver('linkedin')->redirect();
    }//end method linkedin redirect

    public function linkedinCallBack()
    {
        $linkedinUser = Socialite::driver('linkedin')->user();
    
        $existingUser = User::where('email', $linkedinUser->email)->first();
        //dd($existingUser->email);

        if ($existingUser) {

            $existingUser->linkedin_id = $linkedinUser->id;
            $existingUser->linkedin_token = $linkedinUser->token;
            $existingUser->save();

            // Log the user in if they already exist
            Auth::login($existingUser);
            
                return redirect('/dashboard');
        } else{

        }
        return redirect(route('auth'))->with('error','accout or password is not exit');

    }//end method linkedin callback

    public function comfirmPassword()
    {
        return view('auth.confirm-password');
    }//end method comfirm password

    public function comfirmPasswordCheck(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }
    
        $request->session()->passwordConfirmed();
    
        return redirect()->intended();
    }//end method comfirm password check
    
}//end class

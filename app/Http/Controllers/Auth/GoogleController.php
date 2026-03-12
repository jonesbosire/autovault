<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class GoogleController extends Controller
{
    public function redirect() { return Socialite::driver('google')->redirect(); }
    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                ['name' => $googleUser->getName(), 'google_id' => $googleUser->getId(), 'avatar_url' => $googleUser->getAvatar(), 'email_verified_at' => now(), 'password' => bcrypt(str()->random(32))]
            );
            if (!$user->google_id) { $user->update(['google_id' => $googleUser->getId(), 'avatar_url' => $googleUser->getAvatar()]); }
            Auth::login($user, true);
            return redirect()->intended(route('my-listings.index'));
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['google' => 'Google login failed. Please try again.']);
        }
    }
}

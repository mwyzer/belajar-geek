<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OtpController extends Controller
{
    /**
     * Show OTP verification form.
     *
     * @return \Inertia\Response
     */
    public function show()
    {
        return inertia('Auth/VerifyOtp');
    }

    /**
     * Send OTP to user's email.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate OTP
        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10); // OTP expires in 10 minutes
        $user->save();

        // Send OTP via Email
        Mail::raw("Your OTP is: $otp", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your OTP Code');
        });

        return back()->with('success', 'OTP sent successfully to your email.');
    }

    /**
     * Verify OTP.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)
                    ->where('otp', $request->otp)
                    ->where('otp_expires_at', '>=', Carbon::now())
                    ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Invalid OTP or OTP has expired.']);
        }

        // Clear OTP fields
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->email_verified_at = now();
        $user->save();

        // Log in user after OTP verification
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'OTP verified successfully. You are now logged in.');
    }
}

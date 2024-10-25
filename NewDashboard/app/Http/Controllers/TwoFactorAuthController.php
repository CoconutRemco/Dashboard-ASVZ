<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FALaravel\Support\Google2FA;

class TwoFactorAuthController extends Controller
{
public function enableTwoFactor(Request $request)
{
$user = $request->user();
$google2fa = new Google2FA();

$user->two_factor_secret = $google2fa->generateSecretKey();
$user->two_factor_enabled = true;
$user->save();

return response()->json([
'qr_code' => $google2fa->getQRCodeInline(
config('app.name'),
$user->email,
$user->two_factor_secret
),
]);
}

public function verifyTwoFactor(Request $request)
{
$user = $request->user();
$google2fa = new Google2FA();

if ($google2fa->verifyKey($user->two_factor_secret, $request->otp)) {
session(['two_factor_authenticated' => true]);

return redirect()->intended('dashboard');
}

return back()->withErrors(['otp' => 'Invalid OTP']);
}
}

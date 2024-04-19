<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;

class VerifyEmailController extends Controller
{

    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect(env('FRONT_URL') . '/email/verify/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect(env('FRONT_URL') . '/email/verify/success');
    }

    /*
    public function __invokeTrainer(Request $request): RedirectResponse
    {
        $trainer = Trainer::find($request->route('id'));

        if ($trainer->hasVerifiedEmail()) {
            return redirect(env('FRONT_URL') . '/trainer/email/verify/already-success');
        }

        if ($trainer->markEmailAsVerified()) {
            event(new Verified($trainer));
        }

        return redirect(env('FRONT_URL') . '/trainer/email/verify/success');
    }
    */

}

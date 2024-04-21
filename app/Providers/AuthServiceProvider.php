<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use Laravel\Passport\Passport;
use Laravel\Passport\HasApiTokens;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::tokensCan(
            [
                'user' => 'User Type',
                'trainer' => 'Trainer User Type'
            ]
        );

        VerifyEmail::toMailUsing(function($notifiable,$url){
            $spaUrl = $url;

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click The Button Below to Verify Your Email Address.')
                ->action('Verify Email Address',$spaUrl)
                ->view('auth.verify', compact('url'));
        });

        //
    }
}

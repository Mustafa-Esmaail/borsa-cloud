<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\URL;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
        $this->registerPolicies();

    VerifyEmail::toMailUsing(function ($notifiable, $url) {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Confirm your email')
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $url);
    });
    }
}

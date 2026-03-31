<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Support\Facades\FilamentView;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use App\Listeners\HandleUserLoginAttempts;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentView::registerRenderHook(
            'panels::body.start',
            fn(): string => Blade::render('
                <div wire:loading.delay.short>
                    <div style="
                        position: fixed;
                        top: 0; left: 0;
                        width: 100%; height: 100%;
                        background: rgba(0, 0, 0, 0.5);
                        backdrop-filter: blur(4px);
                        z-index: 9999;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column;
                        color: white;
                        font-family: sans-serif;
                    ">
                        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-primary-500 mb-4"></div>
                        <p class="text-lg font-semibold">Memproses data...</p>
                    </div>
                </div>
            ')
        );

        Event::listen(Failed::class, HandleUserLoginAttempts::class);
        Event::listen(Login::class, HandleUserLoginAttempts::class);
    }
}

<?php

namespace App\Providers;

use App\Enums\VisibilityEnum;
use App\Models\Paste;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

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
        $publicPastes = Paste::query()
            ->where('visibility', VisibilityEnum::Public->value)
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
        Inertia::share([
            'public' => $publicPastes,
        ]);
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FooterItem;
use Illuminate\Support\Facades\View;
use App\Models\Service;

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
    public function boot()
    {
        // Load footer items globally
        View::composer('*', function ($view) {
            $footerItems = FooterItem::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->groupBy('type');

            $services = Service::with('subServices')
                ->orderBy('name', 'asc') // safer sorting
                ->get();
            
            $view->with('footerItems', $footerItems)
                 ->with('services', $services);
        });
    }
}

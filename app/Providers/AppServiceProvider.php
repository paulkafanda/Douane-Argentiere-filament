<?php

namespace App\Providers;

use App\Models\Client;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

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
        Model::shouldBeStrict();
        Model::unguard();

        EditAction::configureUsing(function ($action) {
            return $action->slideOver();
        });
        CreateAction::configureUsing(function ($action) {
            return $action->slideOver();
        });
    }
}

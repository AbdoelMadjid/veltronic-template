<?php

namespace App\Providers;

use App\Support\ThemeVersion;
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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $version = ThemeVersion::current();
            $currentRoute = \Illuminate\Support\Facades\Route::currentRouteName() ?? '';
            $forceLegacyUi = str_starts_with($currentRoute, 'pages.authentication.');
            $defaultVersion = ThemeVersion::default();

            $layoutVersion = $forceLegacyUi ? $defaultVersion : $version;
            $layout = ThemeVersion::resolveView('layouts.index', $layoutVersion);

            $assetPack = config('theme.asset_pack', 'auto');
            $assetPack = $assetPack === 'auto' ? $version : $assetPack;
            $assetPack = ThemeVersion::normalize($assetPack);

            $menuStyle = config('theme.menu_style', 'auto');
            $menuStyle = $menuStyle === 'auto' ? $version : $menuStyle;
            $menuStyle = ThemeVersion::normalize($menuStyle);

            if ($forceLegacyUi) {
                $assetPack = $defaultVersion;
                $menuStyle = $defaultVersion;
            }

            $assetBase = ThemeVersion::assetBase($assetPack);
            $authUser = auth()->user();
            $avatar = $authUser?->profile_photo_url
                ?? $authUser?->avatar_url
                ?? (isset($authUser?->avatar) && is_string($authUser->avatar)
                    ? (str_starts_with($authUser->avatar, 'http') ? $authUser->avatar : asset(ltrim($authUser->avatar, '/')))
                    : null)
                ?? asset($assetBase.'/media/avatars/300-1.jpg');

            $view->with('layout', $layout);
            $view->with('theme_version', $version);
            $view->with('theme_asset_pack', $assetPack);
            $view->with('theme_asset_base', $assetBase);
            $view->with('theme_menu_style', $menuStyle);
            $view->with('current_user_display', [
                'name' => $authUser?->name ?? 'Guest User',
                'email' => $authUser?->email ?? '',
                'avatar' => $avatar,
            ]);
        });
    }
}

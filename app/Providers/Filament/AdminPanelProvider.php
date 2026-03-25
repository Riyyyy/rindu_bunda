<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                'panels::body.start',
                fn () => new \Illuminate\Support\HtmlString('
                    <style>
                        /* Paksa semua teks label required (*) jadi merah */
                        .fi-fo-field-wrp-label-indicator {
                            color: #ff0000 !important;
                        }
                        /* Paksa semua pesan error di bawah input jadi merah menyala dan ramping (normal) */
                        .fi-fo-field-wrp-error-message, .fi-fo-field-wrp-error-message p, .text-danger-600, .text-red-600 {
                            color: #ff0000 !important;
                            font-weight: normal !important;
                        }
                        /* Paksa semua input yang error punya border merah ramping */
                        .fi-input-wrp.fi-error {
                            border: 1px solid #ff0000 !important;
                            box-shadow: 0 0 5px rgba(255, 0, 0, 0.2) !important;
                        }
                        /* Custom helper text merah kita juga dipaksa ramping */
                        .text-red-600 {
                            color: #ff0000 !important;
                            font-weight: normal !important;
                        }
                    </style>
                ')
            );
    }
}

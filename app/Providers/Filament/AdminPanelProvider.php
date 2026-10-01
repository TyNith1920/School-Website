<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
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
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->simplePageMaxContentWidth('4xl') // wider card for the split layout
            ->colors([
                'primary' => Color::hex('#1d00af'),
                'danger'  => Color::Rose,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
                'info'    => Color::Blue,
            ])
            ->navigationGroups([
                NavigationGroup::make('Academic & Info')->icon('heroicon-o-academic-cap'),
                NavigationGroup::make('Admissions & Careers')->icon('heroicon-o-user-group'),
                NavigationGroup::make('Website Content')->icon('heroicon-o-globe-alt'),
                NavigationGroup::make('Communications')->icon('heroicon-o-chat-bubble-left-right'),
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('3s')

            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* ==========================================
                           1. DASHBOARD SIDEBAR & TOPBAR (unchanged)
                        ========================================== */
                        aside.fi-sidebar { background-color: #0b1240 !important; }
                        aside.fi-sidebar .fi-sidebar-item-label,
                        aside.fi-sidebar .fi-sidebar-group-label { color: #ffffff !important; }

                        html:not(.dark) aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #0b1240 !important; font-weight: 800 !important;
                        }
                        html.dark aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #ffffff !important; font-weight: 800 !important;
                        }
                        aside.fi-sidebar .fi-sidebar-item-button:hover { background-color: rgba(255,255,255,0.1) !important; }

                        html:not(.dark) header.fi-topbar {
                            background-color: #ffffff !important;
                            border-bottom: 2px solid #e2e8f0 !important;
                        }
                        html:not(.dark) main.fi-main { background-color: #f0f2f5 !important; }

                        ul.fi-sidebar-nav-items > li.fi-sidebar-item:first-child svg { color: #e06d64 !important; }
                        li.fi-sidebar-group:nth-of-type(1) button svg { color: #3b82f6 !important; }
                        li.fi-sidebar-group:nth-of-type(2) button svg { color: #10b981 !important; }
                        li.fi-sidebar-group:nth-of-type(3) button svg { color: #f59e0b !important; }
                        li.fi-sidebar-group:nth-of-type(4) button svg { color: #8b5cf6 !important; }

                        header.fi-topbar button svg {
                            color: #fbd38d !important;
                            transition: all 0.2s ease-in-out !important;
                        }
                        header.fi-topbar button:hover svg { color: #f59e0b !important; transform: scale(1.15) !important; }

                        header.fi-topbar button span[class*="bg-"],
                        header.fi-topbar button div[class*="bg-"] {
                            background-color: #ef4444 !important; color: #ffffff !important;
                            border: none !important; box-shadow: 0 0 8px rgba(239,68,68,0.6) !important;
                        }

                        /* ==========================================
                           2. NEW LOGIN: "SCHOOL NOTEBOOK" SPLIT CARD
                           Left  = deep blue brand panel
                           Right = warm paper with faint ruled lines
                        ========================================== */
                        .fi-simple-layout {
                            background: #0b1240 !important;
                            background-image:
                                radial-gradient(60rem 30rem at 85% -10%, rgba(29,0,175,0.55), transparent 70%),
                                radial-gradient(40rem 25rem at 0% 110%, rgba(224,109,100,0.18), transparent 70%) !important;
                            min-height: 100vh !important;
                        }

                        /* The card */
                        .fi-simple-main {
                            position: relative !important;
                            overflow: hidden !important;
                            background-color: #fbf9f4 !important;
                            background-image: repeating-linear-gradient(
                                to bottom, transparent 0, transparent 31px, rgba(29,0,175,0.07) 31px, rgba(29,0,175,0.07) 32px) !important;
                            border: 0 !important;
                            border-radius: 1.5rem !important;
                            box-shadow: 0 40px 80px -20px rgba(0,0,0,0.65) !important;
                            width: 100% !important;
                            max-width: 60rem !important;
                            margin-inline: auto !important;
                            padding: 3rem 2.75rem 3rem calc(22rem + 2.75rem) !important;
                            min-height: 30rem;
                        }

                        /* Left brand panel (pure CSS, no extra blade file) */
                        .fi-simple-main::before {
                            content: "Life International School\A\A Admin portal\A Manage admissions, academics and website content in one place.";
                            white-space: pre-line;
                            position: absolute; inset: 0 auto 0 0; width: 22rem;
                            display: flex; flex-direction: column; justify-content: flex-end;
                            padding: 2.5rem;
                            color: #ffffff; font-size: 0.95rem; line-height: 1.6;
                            background:
                                linear-gradient(160deg, rgba(29,0,175,0.0) 40%, rgba(11,18,64,0.85)),
                                linear-gradient(135deg, #1d00af 0%, #0b1240 100%);
                            border-right: 6px solid #e06d64; /* the "margin line" of a notebook */
                        }

                        /* Logo sits on the paper side */
                        .fi-simple-layout img {
                            height: 4rem !important;
                            object-fit: contain !important;
                            margin: 0 0 0.75rem 0 !important;
                        }

                        .fi-simple-header-heading,
                        .fi-simple-header h1 {
                            color: #0b1240 !important;
                            font-weight: 800 !important;
                            font-size: 1.75rem !important;
                            letter-spacing: -0.02em !important;
                        }

                        /* Labels */
                        .fi-fo-field-wrp-label label,
                        .fi-fo-field-wrp-label span,
                        .fi-checkbox-label,
                        label span {
                            color: #1e293b !important;
                            font-weight: 600 !important;
                        }

                        /* Inputs */
                        .fi-input-wrp {
                            background-color: #ffffff !important;
                            border: 1.5px solid #cbd5e1 !important;
                            border-radius: 0.75rem !important;
                            box-shadow: none !important;
                        }
                        .fi-input-wrp:focus-within {
                            border-color: #1d00af !important;
                            box-shadow: 0 0 0 4px rgba(29,0,175,0.15) !important;
                        }
                        .fi-input-wrp input { color: #0f172a !important; background: transparent !important; }

                        /* Button */
                        .fi-btn-primary, button[type="submit"] {
                            background: #1d00af !important;
                            border-radius: 0.75rem !important;
                            font-weight: 700 !important;
                            padding-top: 0.8rem !important;
                            padding-bottom: 0.8rem !important;
                            transition: background-color .2s ease, box-shadow .2s ease !important;
                        }
                        .fi-btn-primary:hover, button[type="submit"]:hover {
                            background: #2a10d6 !important;
                            box-shadow: 0 8px 18px -6px rgba(29,0,175,0.55) !important;
                        }
                        .fi-btn-primary:focus-visible, button[type="submit"]:focus-visible {
                            outline: 3px solid #e06d64 !important; outline-offset: 2px !important;
                        }

                        /* Phones: drop the left panel, keep the paper card */
                        @media (max-width: 820px) {
                            .fi-simple-main { padding: 2rem 1.5rem !important; min-height: 0; }
                            .fi-simple-main::before { display: none; }
                        }
                    </style>
                ')
            )
            ->brandName('Life International School')
            ->brandLogo(asset('images/lis.png'))
            ->brandLogoHeight('4rem')
            ->favicon(asset('images/logo.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
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
            ]);
    }
}
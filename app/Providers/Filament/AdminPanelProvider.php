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
                           1. DASHBOARD SIDEBAR & TOPBAR
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
                           2. SPLIT-SCREEN LOGIN CARD DESIGN
                        ========================================== */
                        /* Background overall page */
                        html, body, .fi-simple-layout {
                            background-color: #090e29 !important;
                            min-height: 100vh !important;
                            display: flex !important;
                            align-items: center !important;
                            justify-content: center !important;
                        }

                        .fi-simple-layout > div {
                            width: 100% !important;
                            max-width: 900px !important;
                            padding: 1.5rem !important;
                        }

                        /* Container holding both side banner & form */
                        .fi-simple-main {
                            display: grid !important;
                            grid-template-columns: 1fr 1fr !important;
                            background-color: #fcfbf7 !important;
                            border-radius: 1.5rem !important;
                            overflow: hidden !important;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
                            padding: 0 !important;
                            border: none !important;
                            max-width: 100% !important;
                            width: 100% !important;
                            position: relative !important;
                        }

                        /* Responsive for Mobile */
                        @media (max-width: 768px) {
                            .fi-simple-main {
                                grid-template-columns: 1fr !important;
                            }
                            .fi-simple-main::before {
                                display: none !important;
                            }
                        }

                        /* Left Blue Banner Section using ::before */
                        .fi-simple-main::before {
                            content: "" !important;
                            background: linear-gradient(135deg, #1d00af 0%, #150080 100%) !important;
                            border-right: 4px solid #e06d64 !important;
                            height: 100% !important;
                            width: 100% !important;
                            display: block !important;
                        }

                        /* Inject text into the left banner */
                        .fi-simple-main::after {
                            content: "Life International School\\A\\A Admin portal\\A Manage admissions, academics and website content in one place." !important;
                            white-space: pre-wrap !important;
                            position: absolute !important;
                            top: 50% !important;
                            left: 5% !important;
                            width: 40% !important;
                            transform: translateY(-50%) !important;
                            color: #ffffff !important;
                            font-size: 0.95rem !important;
                            line-height: 1.6 !important;
                            z-index: 10 !important;
                            pointer-events: none !important;
                        }

                        /* Form Wrapper styling (Right side) */
                        .fi-simple-main > form, 
                        .fi-simple-main > div {
                            padding: 3rem 2.5rem !important;
                            background-color: #fcfbf7 !important;
                        }

                        /* Header inside Form */
                        .fi-simple-header-heading {
                            color: #0b1240 !important;
                            font-size: 2rem !important;
                            font-weight: 700 !important;
                            text-align: left !important;
                            margin-bottom: 1.5rem !important;
                        }

                        /* Input Fields */
                        .fi-input-wrp {
                            background-color: #ffffff !important;
                            border: 1.5px solid #cbd5e1 !important;
                            border-radius: 0.75rem !important;
                            box-shadow: none !important;
                        }
                        .fi-input-wrp input {
                            color: #0f172a !important;
                        }
                        .fi-input-wrp:focus-within {
                            border-color: #1d00af !important;
                            box-shadow: 0 0 0 3px rgba(29, 0, 175, 0.15) !important;
                        }

                        /* Label styling */
                        .fi-fo-field-wrp-label label span {
                            color: #1e293b !important;
                            font-weight: 600 !important;
                        }

                        /* Submit Button */
                        .fi-btn-primary, button[type="submit"] {
                            background-color: #1d00af !important;
                            border-radius: 0.75rem !important;
                            font-weight: 700 !important;
                            padding-top: 0.85rem !important;
                            padding-bottom: 0.85rem !important;
                            width: 100% !important;
                            font-size: 1rem !important;
                            transition: background-color 0.2s ease !important;
                        }
                        .fi-btn-primary:hover, button[type="submit"]:hover {
                            background-color: #150080 !important;
                        }

                        /* Logo Section */
                        .fi-simple-layout img {
                            height: 3.5rem !important;
                            object-fit: contain !important;
                            margin-bottom: 1rem !important;
                        }
                    </style>
                ')
            )
            ->brandName('Life International School')
            ->brandLogo(asset('images/lis.png'))
            ->brandLogoHeight('3.5rem')
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
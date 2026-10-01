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
                NavigationGroup::make('Academic & Info')
                    ->icon('heroicon-o-academic-cap'),
                    
                NavigationGroup::make('Admissions & Careers')
                    ->icon('heroicon-o-user-group'),
                    
                NavigationGroup::make('Website Content')
                    ->icon('heroicon-o-globe-alt'),
                    
                NavigationGroup::make('Communications')
                    ->icon('heroicon-o-chat-bubble-left-right'),
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('3s')
            
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* ==========================================
                           1. DASHBOARD SIDEBAR & TOPBAR STYLES
                        ========================================== */
                        aside.fi-sidebar { background-color: #0b1240 !important; }
                        
                        aside.fi-sidebar .fi-sidebar-item-label, 
                        aside.fi-sidebar .fi-sidebar-group-label { color: #ffffff !important; }
                        
                        html:not(.dark) aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #0b1240 !important; 
                            font-weight: 800 !important; 
                        }

                        html.dark aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #ffffff !important; 
                            font-weight: 800 !important; 
                        }

                        aside.fi-sidebar .fi-sidebar-item-button:hover { background-color: rgba(255, 255, 255, 0.1) !important; }

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

                        header.fi-topbar button:hover svg {
                            color: #f59e0b !important;
                            transform: scale(1.15) !important;
                        }

                        header.fi-topbar button span[class*="bg-"],
                        header.fi-topbar button div[class*="bg-"] {
                            background-color: #ef4444 !important;
                            color: #ffffff !important;
                            border: none !important;
                            box-shadow: 0 0 8px rgba(239, 68, 68, 0.6) !important;
                        }

                        /* ==========================================
                           2. FIXED PRO LOGIN PAGE STYLES
                        ========================================== */
                        html, body, .fi-layout, .fi-simple-layout {
                            background: #090d16 !important;
                            background-image: radial-gradient(at 50% 10%, #1e1b4b 0px, transparent 65%),
                                              radial-gradient(at 100% 100%, #0f172a 0px, transparent 50%) !important;
                            min-height: 100vh !important;
                        }

                        /* Modern Glass Card */
                        .fi-simple-main {
                            background: rgba(20, 27, 45, 0.85) !important;
                            backdrop-filter: blur(20px) saturate(180%) !important;
                            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.15) !important;
                            border-radius: 1.25rem !important;
                            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8), 0 0 30px rgba(29, 0, 175, 0.25) !important;
                            padding: 2.5rem !important;
                        }

                        /* 🌟 រក្សា Logo ដើមឱ្យច្បាស់ល្អ មិនបាច់ប្រើ Invert ទេ */
                        .fi-simple-layout img {
                            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5)) !important;
                            height: 4.5rem !important;
                            object-fit: contain !important;
                            margin: 0 auto 1rem auto !important;
                        }

                        /* 🌟 កែចំណងជើង "Sign in" ឱ្យពណ៌សភ្លឺច្បាស់ */
                        .fi-simple-header-heading, 
                        .fi-simple-header h1 {
                            color: #ffffff !important;
                            font-weight: 800 !important;
                            letter-spacing: -0.02em !important;
                            font-size: 1.85rem !important;
                        }

                        /* 🌟 កែ Labels (Email address, Password, Remember me) ឱ្យពណ៌សច្បាស់ */
                        .fi-fo-field-wrp-label label, 
                        .fi-fo-field-wrp-label span,
                        .fi-checkbox-label,
                        label span {
                            color: #f1f5f9 !important;
                            font-weight: 600 !important;
                        }

                        /* Input Box Clean Style */
                        .fi-input-wrp {
                            background-color: #0f172a !important;
                            border: 1px solid rgba(255, 255, 255, 0.2) !important;
                            border-radius: 0.75rem !important;
                            color: #ffffff !important;
                        }

                        .fi-input-wrp:focus-within {
                            border-color: #6366f1 !important;
                            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.3) !important;
                        }

                        .fi-input-wrp input {
                            color: #ffffff !important;
                            background-color: transparent !important;
                        }

                        /* Button Style Gradient Professional */
                        .fi-btn-primary, button[type="submit"] {
                            background: linear-gradient(135deg, #2563eb 0%, #1d00af 100%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.15) !important;
                            border-radius: 0.75rem !important;
                            font-weight: 700 !important;
                            padding-top: 0.8rem !important;
                            padding-bottom: 0.8rem !important;
                            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.5) !important;
                            transition: all 0.3s ease !important;
                        }

                        .fi-btn-primary:hover, button[type="submit"]:hover {
                            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
                            transform: translateY(-2px) !important;
                            box-shadow: 0 15px 25px -5px rgba(37, 99, 235, 0.7) !important;
                        }
                    </style>
                ')
            )
            ->brandName('Life International School')
            ->brandLogo(asset('images/lis.png'))
            ->brandLogoHeight('5rem')
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
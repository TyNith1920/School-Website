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

                        /* រូបកណ្តឹង (Notification Bell) */
                        header.fi-topbar button svg {
                            color: #fbd38d !important;
                            transition: all 0.2s ease-in-out !important;
                        }

                        header.fi-topbar button:hover svg {
                            color: #f59e0b !important;
                            transform: scale(1.15) !important;
                        }

                        /* Badge Notification */
                        header.fi-topbar button span[class*="bg-"],
                        header.fi-topbar button div[class*="bg-"] {
                            background-color: #ef4444 !important;
                            color: #ffffff !important;
                            border: none !important;
                            box-shadow: 0 0 8px rgba(239, 68, 68, 0.6) !important;
                        }

                        /* ==========================================
                           2. PRO ADMIN LOGIN PAGE STYLES
                        ========================================== */
                        body.fi-body-login {
                            background: radial-gradient(circle at 50% 20%, #0f172a 0%, #080d1a 60%, #020617 100%) !important;
                            position: relative;
                            min-h: 100vh;
                        }

                        /* Ambient Glow Effect */
                        body.fi-body-login::before {
                            content: "";
                            position: absolute;
                            top: 15%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            width: 550px;
                            height: 550px;
                            background: radial-gradient(circle, rgba(29, 0, 175, 0.35) 0%, rgba(245, 158, 11, 0.15) 50%, rgba(0, 0, 0, 0) 70%);
                            filter: blur(90px);
                            pointer-events: none;
                        }

                        /* Glassmorphism Login Card */
                        .fi-simple-layout .fi-simple-main {
                            background: rgba(15, 23, 42, 0.75) !important;
                            backdrop-filter: blur(20px) saturate(180%) !important;
                            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.12) !important;
                            border-radius: 1.5rem !important;
                            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.7), 0 0 30px rgba(29, 0, 175, 0.2) !important;
                            padding: 2.5rem !important;
                            transition: all 0.3s ease !important;
                        }

                        /* Adjust Logo Size on Login */
                        .fi-simple-layout img {
                            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.4));
                            transition: transform 0.3s ease;
                        }
                        
                        .fi-simple-layout img:hover {
                            transform: scale(1.03);
                        }

                        /* Title "Sign in" */
                        .fi-simple-header-heading {
                            color: #ffffff !important;
                            font-weight: 800 !important;
                            letter-spacing: -0.02em !important;
                            font-size: 1.75rem !important;
                        }

                        /* Labels */
                        .fi-fo-field-wrp-label label, 
                        .fi-fo-field-wrp-label span {
                            color: #cbd5e1 !important;
                            font-weight: 600 !important;
                        }

                        /* Input Box Style */
                        .fi-input-wrp {
                            background-color: rgba(30, 41, 59, 0.7) !important;
                            border: 1px solid rgba(255, 255, 255, 0.15) !important;
                            border-radius: 0.75rem !important;
                            color: #ffffff !important;
                            transition: all 0.2s ease-in-out !important;
                        }

                        .fi-input-wrp:focus-within {
                            border-color: #3b82f6 !important;
                            background-color: rgba(30, 41, 59, 0.95) !important;
                            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25) !important;
                        }

                        .fi-input-wrp input {
                            color: #ffffff !important;
                        }

                        /* Checkbox (Remember me) */
                        .fi-checkbox-input {
                            background-color: rgba(30, 41, 59, 0.8) !important;
                            border-color: rgba(255, 255, 255, 0.2) !important;
                            border-radius: 0.375rem !important;
                        }

                        /* Primary Button (Sign in) */
                        .fi-btn-primary {
                            background: linear-gradient(135deg, #1d00af 0%, #173c9c 100%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.1) !important;
                            border-radius: 0.75rem !important;
                            font-weight: 700 !important;
                            padding-top: 0.8rem !important;
                            padding-bottom: 0.8rem !important;
                            box-shadow: 0 10px 25px -5px rgba(29, 0, 175, 0.5) !important;
                            transition: all 0.3s ease !important;
                        }

                        .fi-btn-primary:hover {
                            background: linear-gradient(135deg, #2563eb 0%, #1d00af 100%) !important;
                            transform: translateY(-2px) !important;
                            box-shadow: 0 15px 30px -5px rgba(37, 99, 235, 0.6) !important;
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
            ->widgets([
                // 📍 យើងលុប/បិទ Widgets\AccountWidget::class ចេញ
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
            ]);
    }
}
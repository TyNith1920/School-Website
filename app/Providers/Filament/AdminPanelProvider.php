<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\CustomLogin;
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
            ->login(CustomLogin::class)
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
            ->databaseNotificationsPolling('30s') // កែមក 30s ឬ null ដើម្បីកុំឱ្យ Livewire Re-render ញឹកពេក
            
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* Sidebar styling */
                        aside.fi-sidebar { 
                            background-color: #0b1240 !important; 
                        }
                        
                        aside.fi-sidebar .fi-sidebar-item-label, 
                        aside.fi-sidebar .fi-sidebar-group-label { 
                            color: #ffffff !important; 
                        } 
                        
                        html:not(.dark) aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #0b1240 !important; 
                            font-weight: 800 !important; 
                        }

                        html.dark aside.fi-sidebar .fi-sidebar-item.fi-active > .fi-sidebar-item-button .fi-sidebar-item-label {
                            color: #ffffff !important; 
                            font-weight: 800 !important; 
                        }

                        aside.fi-sidebar .fi-sidebar-item-button:hover { 
                            background-color: rgba(255, 255, 255, 0.1) !important; 
                        }

                        /* Topbar & Main Canvas */
                        html:not(.dark) header.fi-topbar {
                            background-color: #ffffff !important;
                            border-bottom: 2px solid #e2e8f0 !important;
                        }

                        html:not(.dark) main.fi-main { 
                            background-color: #f0f2f5 !important; 
                        }

                        /* Sidebar Group Icons Colors */
                        ul.fi-sidebar-nav-items > li.fi-sidebar-item:first-child svg { color: #e06d64 !important; } 
                        li.fi-sidebar-group:nth-of-type(1) button svg { color: #3b82f6 !important; } 
                        li.fi-sidebar-group:nth-of-type(2) button svg { color: #10b981 !important; } 
                        li.fi-sidebar-group:nth-of-type(3) button svg { color: #f59e0b !important; } 
                        li.fi-sidebar-group:nth-of-type(4) button svg { color: #8b5cf6 !important; } 
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
                // Widgets\AccountWidget::class,
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
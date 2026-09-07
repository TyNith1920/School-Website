<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class WelcomeWidget extends Widget
{
    // ភ្ជាប់ទៅកាន់ File Design (Blade)
    protected static string $view = 'filament.widgets.welcome-widget';
    
    // កំណត់លេខ -10 ដើម្បីរុញប្រអប់នេះឱ្យលោតទៅនៅលើគេបង្អស់ ផុតប្រអប់ផ្សេងៗ
    protected static ?int $sort = -10; 
    
    // កំណត់ឱ្យវាលាតសន្ធឹងពេញអេក្រង់
    protected int | string | array $columnSpan = 'full';
}
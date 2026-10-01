<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseLogin;

class CustomLogin extends BaseLogin
{
    protected static string $view = 'filament.pages.auth.custom-login';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent()
                    ->prefixIcon('heroicon-m-envelope'), // Icon សំបុត្រ/អ៊ីមែល

                // ប្រើ TextInput ផ្ទាល់ខ្លួនដើម្បីបំបាត់ Icon ភ្នែកឌុបជាន់គ្នា
                TextInput::make('password')
                    ->label(__('filament-panels::pages/auth/login.form.password.label'))
                    ->password()
                    ->revealable() // បើកត្រឹមតែ 1 Icon របស់ Filament
                    ->required()
                    ->prefixIcon('heroicon-m-lock-closed') // Icon សោរ/Password
                    ->extraInputAttributes(['data-ms-reveal' => 'false']),

                $this->getRememberFormComponent(), // Remember me
            ])
            ->statePath('data');
    }
}
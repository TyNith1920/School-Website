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
                    ->prefixIcon('heroicon-m-envelope'), // បន្ថែម Icon អ៊ីមែលនៅខាងឆ្វេង

                $this->getPasswordFormComponent()
                    ->prefixIcon('heroicon-m-lock-closed'), // បន្ថែម Icon Password នៅខាងឆ្វេង
                
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }
}
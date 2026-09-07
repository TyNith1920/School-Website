<?php

namespace App\Filament\Resources\AccreditationResource\Pages;

use App\Filament\Resources\AccreditationResource;
use Filament\Actions;
use Filament\Actions\Action; // 📍 បានថែមបន្ទាត់នេះសម្រាប់ហៅប៊ូតុង
use Filament\Resources\Pages\EditRecord;

class EditAccreditation extends EditRecord
{
    protected static string $resource = AccreditationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 📍 ១. ប៊ូតុង Save នៅខាងលើ (ដើម្បីកុំឱ្យពិបាកអូសទៅក្រោម)
            Action::make('save')
                ->label('Save changes')
                ->action('save') // បញ្ជាឱ្យដំណើរការមុខងារ Save
                ->color('primary'),

            // 📍 ២. នេះជាប៊ូតុង Back 
            Action::make('back')
                ->label('Back')
                ->icon('heroicon-m-arrow-left')
                ->color('gray')
                ->url(fn (): string => $this->getResource()::getUrl('index')),

            // 📍 ៣. ប៊ូតុង Delete
            Actions\DeleteAction::make(),
        ];
    }

    // 📍 មុខងាររុញទៅក្រោយ (Back) ដោយស្វ័យប្រវត្តិពេលចុច Save រួច
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
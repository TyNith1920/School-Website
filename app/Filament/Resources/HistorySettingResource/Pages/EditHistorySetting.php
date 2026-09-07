<?php

namespace App\Filament\Resources\HistorySettingResource\Pages;

use App\Filament\Resources\HistorySettingResource;
use Filament\Actions;
use Filament\Actions\Action; // 📍 កុំភ្លេចថែមបន្ទាត់នេះ
use Filament\Resources\Pages\EditRecord;

class EditHistorySetting extends EditRecord
{
    protected static string $resource = HistorySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // 📍 ១. ប៊ូតុង Save នៅខាងលើ
            Action::make('save')
                ->label('Save changes')
                ->action('save') 
                ->color('primary'),

            // 📍 ២. ប៊ូតុង Back 
            Action::make('back')
                ->label('Back')
                ->icon('heroicon-m-arrow-left')
                ->color('gray')
                ->url(fn (): string => $this->getResource()::getUrl('index')),

            // ៣. ប៊ូតុង Delete
            Actions\DeleteAction::make(),
        ];
    }

    // 📍 ៤. មុខងាររុញទៅក្រោយដោយស្វ័យប្រវត្តិពេល Save រួច
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
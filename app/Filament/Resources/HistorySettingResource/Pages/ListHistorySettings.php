<?php

namespace App\Filament\Resources\HistorySettingResource\Pages;

use App\Filament\Resources\HistorySettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHistorySettings extends ListRecords
{
    protected static string $resource = HistorySettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

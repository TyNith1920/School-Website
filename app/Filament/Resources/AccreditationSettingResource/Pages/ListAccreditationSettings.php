<?php

namespace App\Filament\Resources\AccreditationSettingResource\Pages;

use App\Filament\Resources\AccreditationSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccreditationSettings extends ListRecords
{
    protected static string $resource = AccreditationSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

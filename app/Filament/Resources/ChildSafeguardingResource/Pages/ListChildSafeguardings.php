<?php

namespace App\Filament\Resources\ChildSafeguardingResource\Pages;

use App\Filament\Resources\ChildSafeguardingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChildSafeguardings extends ListRecords
{
    protected static string $resource = ChildSafeguardingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

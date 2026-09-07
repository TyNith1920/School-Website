<?php

namespace App\Filament\Resources\CareerBannerResource\Pages;

use App\Filament\Resources\CareerBannerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareerBanners extends ListRecords
{
    protected static string $resource = CareerBannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

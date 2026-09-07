<?php

namespace App\Filament\Resources\EnrollmentPageResource\Pages;

use App\Filament\Resources\EnrollmentPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnrollmentPages extends ListRecords
{
    protected static string $resource = EnrollmentPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

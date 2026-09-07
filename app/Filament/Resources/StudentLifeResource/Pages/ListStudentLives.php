<?php

namespace App\Filament\Resources\StudentLifeResource\Pages;

use App\Filament\Resources\StudentLifeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStudentLives extends ListRecords
{
    protected static string $resource = StudentLifeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

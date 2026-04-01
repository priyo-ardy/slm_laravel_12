<?php

namespace App\Filament\Resources\ApqpStages\Pages;

use App\Filament\Resources\ApqpStages\ApqpStagesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApqpStages extends ListRecords
{
    protected static string $resource = ApqpStagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

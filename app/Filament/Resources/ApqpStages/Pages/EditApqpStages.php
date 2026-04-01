<?php

namespace App\Filament\Resources\ApqpStages\Pages;

use App\Filament\Resources\ApqpStages\ApqpStagesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApqpStages extends EditRecord
{
    protected static string $resource = ApqpStagesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}

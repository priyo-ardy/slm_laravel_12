<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UsersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\ExportAction;
use App\Filament\Exports\UserExporter;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Notifications\Notification;

class ListUsers extends ListRecords
{
    protected static string $resource = UsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->icon('heroicon-o-plus-circle'),
            ExportAction::make()
                ->icon('heroicon-o-arrow-down-tray')
                ->exporter(UserExporter::class)
                ->formats([
                    ExportFormat::Xlsx,
                    ExportFormat::Csv
                ])
        ];
    }
}

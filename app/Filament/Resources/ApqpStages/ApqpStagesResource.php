<?php

namespace App\Filament\Resources\ApqpStages;

use App\Filament\Resources\ApqpStages\Pages\CreateApqpStages;
use App\Filament\Resources\ApqpStages\Pages\EditApqpStages;
use App\Filament\Resources\ApqpStages\Pages\ListApqpStages;
use App\Filament\Resources\ApqpStages\Schemas\ApqpStagesForm;
use App\Filament\Resources\ApqpStages\Tables\ApqpStagesTable;
use App\Models\ApqpStages;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApqpStagesResource extends Resource
{
    protected static ?string $model = ApqpStages::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'APQP Stage Setup';

    public static function form(Schema $schema): Schema
    {
        return ApqpStagesForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApqpStagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListApqpStages::route('/'),
            'create' => CreateApqpStages::route('/create'),
            'edit' => EditApqpStages::route('/{record}/edit'),
        ];
    }
}

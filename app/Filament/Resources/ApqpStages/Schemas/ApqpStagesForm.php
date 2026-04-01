<?php

namespace App\Filament\Resources\ApqpStages\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApqpStagesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')->label('Stage No.'),
                TextInput::make('name')->label('Stage Name')->maxLength(255)->required(),
                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'on_progress' => 'On Progress',
                        'pending' => 'Pending',
                        'review' => 'Under Review',
                        'reject' => 'Reject',
                        'close' => 'Close'
                    ])->required(),
                Select::make('prerequisites')
                    ->label('Select prequisite document')
                    ->multiple()
                    ->relationship('prerequisites', 'name')
                    ->preload()
                    ->required()
            ]);
    }
}

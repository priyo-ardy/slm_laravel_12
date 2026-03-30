<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->revealable()
                    ->required(fn($context) => $context === 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->mutateDehydratedStateUsing(fn($state) => Hash::make($state)),
                Select::make('role')
                    ->options([
                        'admin' => 'Administrator',
                        'user' => 'User'
                    ])
                    ->native(false)
            ]);
    }
}

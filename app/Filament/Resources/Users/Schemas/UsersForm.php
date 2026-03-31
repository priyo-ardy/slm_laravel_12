<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class UsersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->schema([
                Section::make('User Information')
                    ->description('User Information Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Full Name')
                                    ->required()
                                    ->placeholder('Full Name')
                                    ->autocomplete(false)
                                    ->maxLength(255),

                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->autocomplete(false)
                                    ->required()
                                    ->placeholder('Email Address')
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),

                                TextInput::make('phone')
                                    ->label('Phone Number')
                                    ->tel()
                                    ->placeholder('Phone Number')
                                    ->required()
                                    ->maxLength(20),

                                Select::make('role')
                                    ->options([
                                        'admin' => 'Administrator',
                                        'user' => 'User'
                                    ])
                                    ->native(false)
                                    ->required(),

                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->revealable()
                                    ->placeholder('Password')
                                    ->required(fn($context) => $context === 'create')
                                    ->dehydrated(fn($state) => filled($state))
                                    ->mutateDehydratedStateUsing(fn($state) => Hash::make($state))
                                    ->columnSpanFull(), // Agar password memenuhi baris di dalam section

                                Textarea::make('remark')
                                    ->label('Remark')
                                    ->placeholder("Additional Information")
                                    ->trim()
                                    ->disableGrammarly()
                                    ->cols(20)
                                    ->columnSpanFull()
                                    ->rows(5)
                            ]),
                    ])->columnSpan(2),
                Section::make('User Image')
                    ->description('Upload user image')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Photo Profile')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->alignCenter()
                            ->visibility('public')
                            ->disk('public')
                            ->directory('user-photo')
                    ])->columnSpan(1)
            ]);
    }
}

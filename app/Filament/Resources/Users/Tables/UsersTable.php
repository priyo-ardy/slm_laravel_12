<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\ExportAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public')->visibility('public')->width(50)->circular()->label('Image'),
                TextColumn::make('name')->label('Full Name'),
                TextColumn::make('email')->label('Email Address'),
                TextColumn::make('phone')->label('Phone Number'),
                TextColumn::make('role')->label('User Role'),
                IconColumn::make('is_locked')->label('Locked Status')->boolean()->trueIcon('heroicon-o-lock-closed')->falseIcon('heroicon-o-lock-open')->trueColor('danger')->falseColor('success')->alignCenter(),
                TextColumn::make('last_login'),
                TextColumn::make('login_from'),
                TextColumn::make('created_at')->label('Created At')
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}

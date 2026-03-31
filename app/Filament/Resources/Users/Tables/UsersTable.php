<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\FileUpload;
use Carbon\Carbon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->disk('public')->visibility('public')->width(50)->circular()->label('Image'),
                TextColumn::make('name')->label('Full Name')->searchable(),
                TextColumn::make('email')->label('Email Address')->searchable(),
                TextColumn::make('phone')->label('Phone Number')->searchable(),
                TextColumn::make('role')->label('User Role')->searchable(),
                IconColumn::make('is_locked')->label('Locked Status')->boolean()->trueIcon('heroicon-o-lock-closed')->falseIcon('heroicon-o-lock-open')->trueColor('danger')->falseColor('success')->alignCenter(),
                TextColumn::make('last_login')->searchable()->formatStateUsing(fn($state) => $state ? Carbon::parse($state)->format('d/M/Y H:i:s') : '-')->label('Last Login'),
                TextColumn::make('login_from')->searchable()->formatStateUsing(fn($state) => $state ? $state : '-')->label('Login From'),
                TextColumn::make('created_at')->label('Created At')->searchable()->formatStateUsing(fn($state) => Carbon::parse($state)->format('d/M/Y H:i:s'))->label('Created At'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
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

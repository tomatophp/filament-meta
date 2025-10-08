<?php

namespace TomatoPHP\FilamentMeta\Filament\RelationManager;

use Filament\Actions;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MetaRelationManager extends RelationManager
{
    protected static string $relationship = 'modelMeta';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-meta::messages.label');
    }

    public function form(Schema $form): Schema
    {
        return $form->schema([
            Forms\Components\TextInput::make('key')
                ->label(trans('filament-meta::messages.columns.key'))
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('value')
                ->label(trans('filament-meta::messages.columns.value')),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->headerActions(config('filament-meta.create') ? [
                Actions\CreateAction::make(),
            ] : [])
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label(trans('filament-meta::messages.columns.key'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label(trans('filament-meta::messages.columns.value'))
                    ->view('filament-meta::table-columns.value'),
            ])
            ->filters([

            ])
            ->recordActions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
                Actions\DeleteAction::make(),
            ])
            ->toolbarActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

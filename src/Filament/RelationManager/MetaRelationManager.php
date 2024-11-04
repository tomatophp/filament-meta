<?php

namespace TomatoPHP\FilamentMeta\Filament\RelationManager;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class MetaRelationManager extends RelationManager
{
    protected static string $relationship = 'modelMeta';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return trans('filament-meta::messages.label');
    }

    public function form(Form $form): Form
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
                CreateAction::make(),
            ] : [])
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->label(trans('filament-meta::messages.columns.key'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('value')
                    ->label(trans('filament-meta::messages.columns.value'))
                    ->view('filament-meta::table-columns.value'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

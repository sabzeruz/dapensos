<?php

namespace App\Filament\Resources;

use App\Models\InfoPembuat;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use App\Filament\Resources\InfoPembuatResource\Pages;

class InfoPembuatResource extends Resource
{
    protected static ?string $model = InfoPembuat::class;

    protected static ?string $navigationLabel = 'Info Pembuat';
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
            ->required()
            ->maxLength(255),

            Forms\Components\TextInput::make('deskripsi' )
            ->required()
            ->maxLength(255),

            Forms\Components\FileUpload::make('gambar')
                ->image()
                ->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            TextColumn::make('nama')->sortable()->searchable(),
            TextColumn::make('deskripsi')->limit(50),
            ImageColumn::make('gambar')->label('Gambar Pembuat'), // Ganti TextColumn dengan ImageColumn
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfoPembuats::route('/'),
            'create' => Pages\CreateInfoPembuat::route('/create'),
            'edit' => Pages\EditInfoPembuat::route('/{record}/edit'),
        ];
    }
}
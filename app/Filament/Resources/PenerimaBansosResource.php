<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenerimaBansosResource\Pages;
use App\Models\PenerimaBansos;
use App\Models\JenisBantuan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table; // Ini adalah namespace yang benar untuk Table

class PenerimaBansosResource extends Resource {
    protected static ?string $model = PenerimaBansos::class;

    protected static ?string $navigationIcon = 'heroicon-o-home'; // Ganti dengan ikon yang tersedia

    public static function form(Form $form): Form {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_telepon')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_bantuan_id')
                    ->label('Jenis Bantuan')
                    ->options(JenisBantuan::all()->pluck('nama_bantuan', 'id'))
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('alamat')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jenisBantuan.nama_bantuan')->label('Jenis Bantuan')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array {
        return [
            'index' => Pages\ListPenerimaBansos::route('/'),
            'create' => Pages\CreatePenerimaBansos::route('/create'),
            'edit' => Pages\EditPenerimaBansos::route('/{record}/edit'),
        ];
    }
}

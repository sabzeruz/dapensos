<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JenisBantuanResource\Pages;
use App\Filament\Resources\JenisBantuanResource\RelationManagers;
use App\Models\JenisBantuan;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class JenisBantuanResource extends Resource
{
    protected static ?string $model = JenisBantuan::class;

    protected static ?string $pluralLabel = 'Jenis Bantuan';
    protected static ?string $label = 'Jenis Bantuan';
    

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nama_bantuan')
                ->required()
                ->maxLength(100),
            Textarea::make('deskripsi')
                ->nullable(),
            TextInput::make('kriteria')
                ->maxLength(255)
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('nama_bantuan')->searchable(),
                TextColumn::make('deskripsi')->limit(50),
                TextColumn::make('kriteria')->limit(50),
                TextColumn::make('created_at')->dateTime(),
                TextColumn::make('updated_at')->dateTime(),
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
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListJenisBantuans::route('/'),
            'create' => Pages\CreateJenisBantuan::route('/create'),
            'edit' => Pages\EditJenisBantuan::route('/{record}/edit'),
        ];
    }
}

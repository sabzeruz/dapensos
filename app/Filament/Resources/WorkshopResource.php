<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkshopResource\Pages;
use App\Filament\Resources\WorkshopResource\RelationManagers;
use App\Models\Workshop;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Fieldset; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkshopResource extends Resource
{
    protected static ?string $model = Workshop::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

               Fieldset::make('Details')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    
                    Forms\Components\TextArea::make('address')
                    -> rows (3)
                    ->required()
                    ->maxLength(255),
                    
                    Forms\Components\FileUpload::make('thumbnail')
                    ->image()
                    ->required(),
                    
                    Forms\Components\FileUpload::make('venue_thumbnail')
                    ->image()
                    ->required(),
                    
                    Forms\Components\FileUpload::make('bg_map')
                    ->image()
                    ->required(),
                    
                    //added 'about'
                    Forms\Components\TextInput::make('about')
                    ->label('Tentang Workshop')
                    ->required()
                    ->maxLength(255),

                    //added 'price'
                    Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->required()
                    ->prefix('Rp' )
                    ->maxLength(255),

                      //added 'is_open' if want to open workshop or no
                      Forms\Components\Select::make('is_open')
                      ->label('Status')
                      ->options([
                          1 => 'Open',   // 1 berarti terbuka
                          0 => 'Closed', // 0 berarti tertutup
                      ])
                      ->default(1) // Set default ke 'Open'
                      ->required(),
                      
                      Forms\Components\Select::make('has_started')
                      ->label('Sudah Dimulai')
                      ->options([
                          1 => 'Yes',    // 1 berarti sudah dimulai
                          0 => 'No',     // 0 berarti belum dimulai
                      ])
                      ->default(0) // Set default ke 'No'
                      ->required(),
      
                      Forms\Components\DateTimePicker::make('started_at')
                      ->label('Waktu Mulai')
                      ->required(),
      
                      Forms\Components\DateTimePicker::make('time_at')
                      ->label('Waktu Tambahan')
                      ->required(),

                       // added 'instructor'
                       Forms\Components\Select::make('workshop_instructor_id') 
                       ->relationship('Instructor', 'name')
                       ->required()
                       ->label('Workshop Instructor'),

                      // added 'Category'
                      Forms\Components\Select::make('category_id') 
                      ->relationship('category', 'name')
                      ->required()
                      ->label('Category'),
                 
                    Forms\Components\Repeater::make('benefits')
                    ->relationship('benefits')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                        
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn :: make ('thumbnail'),
                
                Tables\Columns\TextColumn :: make ('name')
                ->searchable(),
                
                Tables\Columns\TextColumn :: make ('category.name'),
                
                Tables\Columns\TextColumn :: make ('instructor.name'),
                
                Tables\Columns\IconColumn :: make ('has_started')
                ->boolean()
                ->trueColor('success')
                ->falseColor('danger')
                ->trueIcon('heroicon-o-check-circle')
                ->falseIcon('heroicon-o-x-circle')
                ->label('Started'),
                ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('category')
                ->relationship('category', 'name'),
                
                SelectFilter::make('workshop_instructor_id')
                ->label('workshop_instructor')
                ->relationship('instructor', 'name'),
                
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListWorkshops::route('/'),
            'create' => Pages\CreateWorkshop::route('/create'),
            'edit' => Pages\EditWorkshop::route('/{record}/edit'),
        ];
    }
}

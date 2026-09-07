<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimelineResource\Pages;
use App\Models\Timeline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// 📍 Import មុខងារ Layout និង Components ថ្មីៗ
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class TimelineResource extends Resource
{
    protected static ?string $model = Timeline::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $modelLabel = 'Timeline Event';
    protected static ?string $pluralModelLabel = 'Timeline Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Event Details)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Event Details')
                                    ->description('Enter the year and describe the timeline event')
                                    ->icon('heroicon-o-clock')
                                    ->schema([
                                        TextInput::make('year')
                                            ->label('📅 Year')
                                            ->prefixIcon('heroicon-o-calendar')
                                            ->required()
                                            ->maxLength(255),

                                        Textarea::make('description')
                                            ->label('📝 Event Description')
                                            ->required()
                                            ->rows(5),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Display Settings)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Display Settings')
                                    ->description('Choose the timeline dot color')
                                    ->icon('heroicon-o-paint-brush')
                                    ->schema([
                                        Select::make('color')
                                            ->label('🎨 Dot Color')
                                            ->prefixIcon('heroicon-o-swatch')
                                            ->options([
                                                'blue' => 'Blue',
                                                'pink' => 'Pink',
                                                'orange' => 'Orange',
                                                'purple' => 'Purple',
                                                'green' => 'Green',
                                                'red' => 'Red',
                                                'yellow' => 'Yellow',
                                                'indigo' => 'Indigo',
                                                'cyan' => 'Cyan',
                                            ])
                                            ->required()
                                            ->default('blue'),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),
                            
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')
                    ->label('📅 Year')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),
                    
                TextColumn::make('description')
                    ->label('📝 Description')
                    ->limit(50),
                    
                TextColumn::make('color')
                    ->label('🎨 Color')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)) // ធ្វើឱ្យអក្សរធំនៅខាងមុខ (ឧ. Blue)
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        // 📍 កំណត់ពណ៌ Badge ឱ្យត្រូវនឹងពណ៌ដែលបានរើស
                        'blue', 'cyan', 'indigo' => 'info',
                        'green' => 'success',
                        'orange', 'yellow' => 'warning',
                        'red', 'pink' => 'danger',
                        'purple' => 'primary',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(),
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
            'index' => Pages\ListTimelines::route('/'),
            'create' => Pages\CreateTimeline::route('/create'),
            'edit' => Pages\EditTimeline::route('/{record}/edit'),
        ];
    }
}
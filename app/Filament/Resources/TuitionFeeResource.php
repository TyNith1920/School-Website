<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TuitionFeeResource\Pages;
use App\Models\TuitionFee;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TuitionFeeResource extends Resource
{
    protected static ?string $model = TuitionFee::class;

    protected static ?string $navigationGroup = 'Admissions & Careers';

    protected static ?string $navigationLabel = 'Tuition Fees';

    protected static ?string $modelLabel = 'Tuition Fee';

    protected static ?string $pluralModelLabel = 'Tuition Fees';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // ផ្នែកខាងឆ្វេង (ព័ត៌មានចម្បង និង តម្លៃ)
                Forms\Components\Group::make()
                    ->schema([
                        // 1. ព័ត៌មានកម្មវិធីសិក្សា
                        Forms\Components\Section::make('Program Information')
                            ->description('Basic information about the grade and class schedule')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\TextInput::make('category')
                                    ->label('Program Category')
                                    ->placeholder('e.g. EARLY LEARNING CENTER')
                                    ->datalist([
                                        'EARLY LEARNING CENTER',
                                        'ELEMENTARY SCHOOL',
                                        'SECONDARY SCHOOL',
                                        'HIGH SCHOOL',
                                    ])
                                    ->helperText('Select or type a category')
                                    ->required()
                                    ->maxLength(150)
                                    ->dehydrateStateUsing(fn (?string $state): ?string => blank($state) ? null : strtoupper(trim($state))),

                                Forms\Components\TextInput::make('program_name')
                                    ->label('Program Name')
                                    ->placeholder('e.g. NURSERY, GRADE 1, KINDERGARTEN')
                                    ->required()
                                    ->maxLength(150)
                                    ->dehydrateStateUsing(fn (?string $state): ?string => blank($state) ? null : strtoupper(trim($state))),

                                Forms\Components\TextInput::make('time_schedule')
                                    ->label('Class Schedule')
                                    ->placeholder('e.g. HALF-DAY (8:00 AM – 11:30 AM)')
                                    ->prefixIcon('heroicon-o-clock')
                                    ->required()
                                    ->maxLength(150)
                                    ->columnSpanFull()
                                    ->dehydrateStateUsing(fn (?string $state): ?string => blank($state) ? null : strtoupper(trim($state))),
                            ])
                            ->columns(2),

                        // 2. ព័ត៌មានតម្លៃសិក្សា និងថ្លៃបន្ថែម
                        Forms\Components\Section::make('Tuition & Fee Structure')
                            ->description('Fee rates for tuition, lunch, and additional programs')
                            ->icon('heroicon-o-banknotes')
                            ->schema([
                                Forms\Components\TextInput::make('monthly_fee')
                                    ->label('Monthly Tuition Fee')
                                    ->placeholder('160')
                                    ->prefix('$')
                                    ->helperText('Monthly fee amount (e.g. $160)')
                                    ->required()
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('annual_fee')
                                    ->label('Annual Tuition Fee')
                                    ->placeholder('1,600')
                                    ->prefix('$')
                                    ->helperText('Optional: Annual rate if paid in full')
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('lunch_fee')
                                    ->label('Lunch / Snack Fee')
                                    ->placeholder('30')
                                    ->prefix('$')
                                    ->helperText('Leave blank if not applicable')
                                    ->maxLength(50),

                                Forms\Components\TextInput::make('lunch_fee_label')
                                    ->label('Lunch Label')
                                    ->placeholder('LUNCH / SNACK')
                                    ->default('LUNCH / SNACK')
                                    ->maxLength(100)
                                    ->dehydrateStateUsing(fn (?string $state): ?string => blank($state) ? null : strtoupper(trim($state))),

                                Forms\Components\TextInput::make('after_school_fee')
                                    ->label('After-School Program Fee')
                                    ->placeholder('e.g. $100 or N/A')
                                    ->helperText('Write N/A or the fee amount')
                                    ->maxLength(50)
                                    ->columnSpanFull(),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                // ផ្នែកខាងស្តាំ (Settings & Layout)
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Display Settings')
                            ->description('Styling and visual order on the public website')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Forms\Components\Select::make('theme_color')
                                    ->label('Card Color Theme')
                                    ->options([
                                        'yellow' => '🟡 Yellow (Nursery / Pre-School)',
                                        'green' => '🟢 Green (Kindergarten / Full-Day)',
                                        'blue' => '🔵 Blue (Elementary School)',
                                        'red' => '🔴 Red (Middle School)',
                                        'purple' => '🟣 Purple (High School)',
                                    ])
                                    ->native(false)
                                    ->required()
                                    ->default('yellow'),

                                Forms\Components\TextInput::make('sort_order')
                                    ->label('Display Order')
                                    ->helperText('Lower number shows first (0, 1, 2...)')
                                    ->prefixIcon('heroicon-o-arrows-up-down')
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('program_name')
                    ->label('Program & Category')
                    ->description(fn (TuitionFee $record): ?string => $record->category)
                    ->searchable(['program_name', 'category'])
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('time_schedule')
                    ->label('Schedule')
                    ->icon('heroicon-m-clock')
                    ->searchable()
                    ->wrap()
                    ->placeholder('No schedule'),

                Tables\Columns\TextColumn::make('monthly_fee')
                    ->label('Monthly Fee')
                    ->icon('heroicon-m-banknotes')
                    ->weight('bold')
                    ->color('success')
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('annual_fee')
                    ->label('Annual Fee')
                    ->placeholder('N/A')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('theme_color')
                    ->label('Theme')
                    ->badge()
                    ->formatStateUsing(fn (?string $state): string => ucfirst($state ?? 'Unknown'))
                    ->color(fn (?string $state): string => match ($state) {
                        'yellow' => 'warning',
                        'green' => 'success',
                        'blue' => 'info',
                        'red' => 'danger',
                        'purple' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Filter by Category')
                    ->options(
                        fn (): array => TuitionFee::query()
                            ->whereNotNull('category')
                            ->distinct()
                            ->orderBy('category')
                            ->pluck('category', 'category')
                            ->all()
                    )
                    ->searchable(),

                Tables\Filters\SelectFilter::make('theme_color')
                    ->label('Filter by Color')
                    ->options([
                        'yellow' => 'Yellow',
                        'green' => 'Green',
                        'blue' => 'Blue',
                        'red' => 'Red',
                        'purple' => 'Purple',
                    ]),
            ])
            ->actions([
                // ប៊ូតុង Duplicate ជួយឱ្យកូពីទិន្នន័យចាស់មកកែតែ Schedule ឬ Price បានលឿន
                Tables\Actions\ReplicateAction::make()
                    ->label('Duplicate')
                    ->tooltip('Duplicate this tuition fee'),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No tuition fees added yet')
            ->emptyStateDescription('Create tuition fees or pricing cards to display on the public website.')
            ->emptyStateIcon('heroicon-o-banknotes')
            ->striped();
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTuitionFees::route('/'),
            'create' => Pages\CreateTuitionFee::route('/create'),
            'edit' => Pages\EditTuitionFee::route('/{record}/edit'),
        ];
    }
}
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

    /*
     * មិនដាក់ navigationIcon ព្រោះ Navigation Group
     * "Admissions & Careers" មាន Icon រួចហើយ។
     */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*
                |--------------------------------------------------------------------------
                | Program Information
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Program Information')
                    ->description(
                        'Enter the program name, category and study schedule.'
                    )
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('category')
                            ->label('Program Category')
                            ->placeholder('EARLY LEARNING CENTER')
                            ->helperText(
                                'Example: Early Learning Center, Elementary School or Secondary School.'
                            )
                            ->required()
                            ->maxLength(150)
                            ->dehydrateStateUsing(
                                fn (?string $state): ?string =>
                                    blank($state)
                                        ? null
                                        : strtoupper(trim($state))
                            ),

                        Forms\Components\TextInput::make('program_name')
                            ->label('Program Name')
                            ->placeholder('NURSERY')
                            ->helperText(
                                'Example: Nursery, Pre-School or Kindergarten.'
                            )
                            ->required()
                            ->maxLength(150)
                            ->dehydrateStateUsing(
                                fn (?string $state): ?string =>
                                    blank($state)
                                        ? null
                                        : strtoupper(trim($state))
                            ),

                        Forms\Components\TextInput::make('time_schedule')
                            ->label('Class Schedule')
                            ->placeholder('HALF-DAY 8:00–11:30')
                            ->helperText(
                                'Use the schedule to distinguish Half-Day and Full-Day programs.'
                            )
                            ->prefixIcon('heroicon-o-clock')
                            ->required()
                            ->maxLength(150)
                            ->columnSpanFull()
                            ->dehydrateStateUsing(
                                fn (?string $state): ?string =>
                                    blank($state)
                                        ? null
                                        : strtoupper(trim($state))
                            ),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | Tuition and Additional Fees
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Tuition and Additional Fees')
                    ->description(
                        'Enter the price exactly as it should appear on the website.'
                    )
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        Forms\Components\TextInput::make('monthly_fee')
                            ->label('Monthly Tuition Fee')
                            ->placeholder('$160')
                            ->helperText(
                                'Include the currency symbol, for example: $160.'
                            )
                            ->prefixIcon('heroicon-o-currency-dollar')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('annual_fee')
                            ->label('Annual Tuition Fee')
                            ->placeholder('$1,600')
                            ->helperText(
                                'Leave blank if the program does not have an annual price.'
                            )
                            ->prefixIcon('heroicon-o-calendar-days')
                            ->maxLength(50),

                        Forms\Components\TextInput::make('lunch_fee')
                            ->label('Lunch or Snack Fee')
                            ->placeholder('$30')
                            ->helperText(
                                'Leave blank if lunch or snack is not offered.'
                            )
                            ->maxLength(50),

                        Forms\Components\TextInput::make('lunch_fee_label')
                            ->label('Lunch Fee Label')
                            ->placeholder('LUNCH / SNACK')
                            ->helperText(
                                'This label is displayed beside the lunch or snack fee.'
                            )
                            ->default('LUNCH / SNACK')
                            ->maxLength(100)
                            ->dehydrateStateUsing(
                                fn (?string $state): ?string =>
                                    blank($state)
                                        ? null
                                        : strtoupper(trim($state))
                            ),

                        Forms\Components\TextInput::make('after_school_fee')
                            ->label('After-School Program Fee')
                            ->placeholder('N/A or $100')
                            ->helperText(
                                'Enter one real value only, for example: N/A or $100.'
                            )
                            ->maxLength(50)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | Display Settings
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Display Settings')
                    ->description(
                        'Choose the card color and its display position.'
                    )
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        Forms\Components\Select::make('theme_color')
                            ->label('Card Color Theme')
                            ->options([
                                'yellow' => 'Yellow — Nursery / Pre-School',
                                'green' => 'Green — Full-Day / Kindergarten',
                                'blue' => 'Blue — Elementary School',
                                'red' => 'Red — Middle School',
                                'purple' => 'Purple — High School',
                            ])
                            ->native(false)
                            ->searchable()
                            ->required()
                            ->default('yellow'),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Display Order')
                            ->helperText(
                                'Lower numbers appear first on the website.'
                            )
                            ->prefixIcon('heroicon-o-bars-arrow-down')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /*
                 * Program name with category below it.
                 */
                Tables\Columns\TextColumn::make('program_name')
                    ->label('Program')
                    ->description(
                        fn (TuitionFee $record): ?string =>
                            $record->category
                    )
                    ->searchable([
                        'program_name',
                        'category',
                    ])
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
                    ->label('Monthly')
                    ->icon('heroicon-m-banknotes')
                    ->weight('bold')
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('annual_fee')
                    ->label('Annual')
                    ->placeholder('N/A')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('theme_color')
                    ->label('Theme')
                    ->badge()
                    ->formatStateUsing(
                        fn (?string $state): string =>
                            ucfirst($state ?? 'Unknown')
                    )
                    ->color(
                        fn (?string $state): string => match ($state) {
                            'yellow' => 'warning',
                            'green' => 'success',
                            'blue' => 'info',
                            'red' => 'danger',
                            'purple' => 'primary',
                            default => 'gray',
                        }
                    )
                    ->sortable(),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order', 'asc')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('theme_color')
                    ->label('Card Theme')
                    ->options([
                        'yellow' => 'Yellow',
                        'green' => 'Green',
                        'blue' => 'Blue',
                        'red' => 'Red',
                        'purple' => 'Purple',
                    ]),

                Tables\Filters\SelectFilter::make('category')
                    ->label('Program Category')
                    ->options(
                        fn (): array => TuitionFee::query()
                            ->whereNotNull('category')
                            ->distinct()
                            ->orderBy('category')
                            ->pluck('category', 'category')
                            ->all()
                    )
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No tuition fees added yet')
            ->emptyStateDescription(
                'Create a tuition fee to display it on the website.'
            )
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
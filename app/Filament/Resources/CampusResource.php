<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampusResource\Pages;
use App\Models\Campus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CampusResource extends Resource
{
    protected static ?string $model = Campus::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $navigationLabel = 'Campus';

    /*
     * កុំដាក់ Navigation Icon ព្រោះ Group
     * "Academic & Info" មាន Icon រួចហើយ។
     */
    // protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?int $navigationSort = 3;

    /*
     * Campus Setting ប្រើតែមួយ Record។
     */
    public static function canCreate(): bool
    {
        return ! Campus::query()->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | Campus Information
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Campus Information')
                    ->description(
                        'Manage the title, description, address, and contact information.'
                    )
                    ->icon('heroicon-o-building-office-2')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->placeholder('LIS Campus Tour')
                            ->prefixIcon('heroicon-o-pencil-square')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\TextInput::make('phone')
                            ->label('Phone Number')
                            ->placeholder('+855 12 345 678')
                            ->prefixIcon('heroicon-o-phone')
                            ->tel()
                            ->required()
                            ->maxLength(50),

                        Forms\Components\Textarea::make('description')
                            ->label('Campus Description')
                            ->placeholder(
                                'Write a short introduction about the school campus...'
                            )
                            ->helperText(
                                'This description will appear in the Campus page banner.'
                            )
                            ->rows(5)
                            ->maxLength(1000)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('address')
                            ->label('Campus Address')
                            ->placeholder(
                                'Preah Sihanouk, Cambodia'
                            )
                            ->prefixIcon('heroicon-o-map-pin')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | Campus Video
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Campus Tour Video')
                    ->description(
                        'Paste the complete YouTube iframe embed code.'
                    )
                    ->icon('heroicon-o-video-camera')
                    ->schema([
                        Forms\Components\Textarea::make('video_url')
                            ->label('YouTube Embed Code')
                            ->placeholder(
                                '<iframe src="https://www.youtube.com/embed/..."></iframe>'
                            )
                            ->helperText(
                                'On YouTube, select Share → Embed → Copy, then paste the complete iframe code here.'
                            )
                            ->rows(7)
                            ->extraInputAttributes([
                                'class' => 'font-mono text-sm',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Google Map
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Google Maps Location')
                    ->description(
                        'Paste the complete Google Maps iframe embed code.'
                    )
                    ->icon('heroicon-o-map')
                    ->schema([
                        Forms\Components\Textarea::make('map_embed_url')
                            ->label('Google Maps Embed Code')
                            ->placeholder(
                                '<iframe src="https://www.google.com/maps/embed?..."></iframe>'
                            )
                            ->helperText(
                                'On Google Maps, select Share → Embed a map → Copy HTML, then paste the complete iframe code here.'
                            )
                            ->rows(7)
                            ->extraInputAttributes([
                                'class' => 'font-mono text-sm',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone Number')
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Phone number copied')
                    ->icon('heroicon-o-phone'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->limit(45)
                    ->wrap()
                    ->placeholder('No address')
                    ->tooltip(
                        function (
                            Tables\Columns\TextColumn $column
                        ): ?string {
                            $state = (string) $column->getState();

                            return mb_strlen($state) > 45
                                ? $state
                                : null;
                        }
                    ),

                Tables\Columns\IconColumn::make('has_video')
                    ->label('Video')
                    ->state(
                        fn (Campus $record): bool =>
                            filled($record->video_url)
                    )
                    ->boolean(),

                Tables\Columns\IconColumn::make('has_map')
                    ->label('Map')
                    ->state(
                        fn (Campus $record): bool =>
                            filled($record->map_embed_url)
                    )
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->color('primary'),

                Tables\Actions\DeleteAction::make()
                    ->label('Delete')
                    ->color('danger')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No campus information found')
            ->emptyStateDescription(
                'Create the Campus setting to display information on the website.'
            )
            ->emptyStateIcon('heroicon-o-building-office-2');
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public static function getRelations(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Resource Pages
    |--------------------------------------------------------------------------
    */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampuses::route('/'),
            'create' => Pages\CreateCampus::route('/create'),
            'edit' => Pages\EditCampus::route('/{record}/edit'),
        ];
    }
}
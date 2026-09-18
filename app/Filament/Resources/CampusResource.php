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

    protected static ?string $navigationLabel = 'Campus Tour & Map';
    protected static ?string $modelLabel = 'Campus Information';
    protected static ?string $pluralModelLabel = 'Campus Information';

    protected static ?int $navigationSort = 3;

    /*
     * Campus Setting ប្រើតែមួយ Record។
     */
    public static function canCreate(): bool
    {
        return ! Campus::query()->exists();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        // ផ្នែកខាងឆ្វេង: ព័ត៌មានទូទៅនៃ Campus
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Campus Information')
                                    ->description('Manage title, intro description, and campus contacts.')
                                    ->icon('heroicon-o-building-office-2')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Page Headline')
                                            ->placeholder('LIS Campus Tour')
                                            ->prefixIcon('heroicon-o-pencil-square')
                                            ->required()
                                            ->maxLength(150),

                                        Forms\Components\TextInput::make('phone')
                                            ->label('Hotline / Phone Number')
                                            ->placeholder('+855 78 517 754')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->tel()
                                            ->required()
                                            ->maxLength(50),

                                        Forms\Components\Textarea::make('description')
                                            ->label('Campus Introduction')
                                            ->placeholder('Write a brief overview of our learning spaces, campus grounds, and facilities...')
                                            ->helperText('This description appears directly inside the Hero Banner.')
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->required()
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('address')
                                            ->label('Campus Physical Address')
                                            ->placeholder('Group 10, Mondol 3, Sangkat 2, Preah Sihanouk, Cambodia')
                                            ->prefixIcon('heroicon-o-map-pin')
                                            ->required()
                                            ->maxLength(255)
                                            ->columnSpanFull(),
                                    ])
                                    ->columns(2),
                            ])
                            ->columnSpan(['sm' => 3, 'md' => 2]),

                        // ផ្នែកខាងស្តាំ: Video & Google Map Embed
                        Forms\Components\Group::make()
                            ->schema([
                                Forms\Components\Section::make('Campus Tour Video')
                                    ->description('Embed code or URL for the campus showcase video.')
                                    ->icon('heroicon-o-video-camera')
                                    ->schema([
                                        Forms\Components\Textarea::make('video_url')
                                            ->label('Video Embed Code or YouTube Link')
                                            ->placeholder('<iframe src="https://www.youtube.com/embed/..."></iframe>')
                                            ->helperText('Paste YouTube iframe code or video URL.')
                                            ->rows(5)
                                            ->extraInputAttributes([
                                                'class' => 'font-mono text-xs',
                                            ]),
                                    ]),

                                Forms\Components\Section::make('Google Maps')
                                    ->description('Interactive Google Maps location.')
                                    ->icon('heroicon-o-map')
                                    ->schema([
                                        Forms\Components\Textarea::make('map_embed_url')
                                            ->label('Google Maps Embed Code')
                                            ->placeholder('<iframe src="https://www.google.com/maps/embed?..."></iframe>')
                                            ->helperText('Share → Embed a map → Copy HTML on Google Maps.')
                                            ->rows(5)
                                            ->extraInputAttributes([
                                                'class' => 'font-mono text-xs',
                                            ]),
                                    ]),
                            ])
                            ->columnSpan(['sm' => 3, 'md' => 1]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->icon('heroicon-o-phone')
                    ->copyable()
                    ->copyMessage('Phone number copied'),

                Tables\Columns\TextColumn::make('address')
                    ->label('Address')
                    ->limit(40)
                    ->color('gray'),

                Tables\Columns\IconColumn::make('has_video')
                    ->label('Video')
                    ->state(fn (Campus $record): bool => filled($record->video_url))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\IconColumn::make('has_map')
                    ->label('Map')
                    ->state(fn (Campus $record): bool => filled($record->map_embed_url))
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y, h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->badge()
                    ->color('success'),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->button()
                    ->color('primary'),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No campus information found')
            ->emptyStateDescription('Create the Campus setting to display information on the website.')
            ->emptyStateIcon('heroicon-o-building-office-2');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampuses::route('/'),
            'create' => Pages\CreateCampus::route('/create'),
            'edit' => Pages\EditCampus::route('/{record}/edit'),
        ];
    }
}
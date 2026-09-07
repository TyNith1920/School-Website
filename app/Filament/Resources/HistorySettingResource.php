<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistorySettingResource\Pages;
use App\Models\HistorySetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HistorySettingResource extends Resource
{
    protected static ?string $model = HistorySetting::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $navigationLabel = 'History Settings';

    protected static ?string $modelLabel = 'History Setting';

    protected static ?string $pluralModelLabel = 'History Settings';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | Banner Slider
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('History Banner Slider')
                    ->description('Upload images or MP4 videos that will appear in the History & Governance banner.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\Repeater::make('banner_slider')
                            ->label('Banner Slides')
                            ->schema([
                                Forms\Components\Select::make('type')
                                    ->label('Media Type')
                                    ->options([
                                        'image' => 'Image',
                                        'video' => 'Video (MP4)',
                                    ])
                                    ->default('image')
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(
                                        fn (Set $set) => $set('file', null)
                                    )
                                    ->native(false)
                                    ->prefixIcon('heroicon-m-squares-2x2'),

                                Forms\Components\FileUpload::make('file')
                                    ->label('Banner File')
                                    ->helperText(
                                        fn (Get $get): string =>
                                            $get('type') === 'video'
                                                ? 'Upload an MP4 video. Recommended maximum size: 100MB.'
                                                : 'Upload a clear JPG, PNG, or WebP image. Recommended size: 1920 × 850px.'
                                    )
                                    ->acceptedFileTypes(
                                        fn (Get $get): array =>
                                            $get('type') === 'video'
                                                ? ['video/mp4']
                                                : ['image/jpeg', 'image/png', 'image/webp']
                                    )
                                    ->directory('history-banners')
                                    ->maxSize(
                                        fn (Get $get): int =>
                                            $get('type') === 'video' ? 102400 : 10240
                                    )
                                    ->openable()
                                    ->downloadable()
                                    ->nullable() // 📍 ប្តូរពី required() មកជា nullable() ដើម្បីកុំឱ្យវាបង្ខំទាមទាររូបភាព
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->minItems(1)
                            ->maxItems(8)
                            ->reorderable()
                            ->collapsible()
                            ->cloneable()
                            ->itemLabel(function (array $state): ?string {
                                $type = $state['type'] ?? 'image';
                                return $type === 'video' ? 'Video Slide' : 'Image Slide';
                            })
                            ->addActionLabel('Add New Slide')
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Vision & Mission
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Vision & Mission')
                    ->description('Enter the school vision and mission displayed on the History page.')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Forms\Components\Textarea::make('vision')
                            ->label('Vision')
                            ->placeholder('Enter the vision of Life International School...')
                            ->helperText('Describe the long-term vision of the school.')
                            ->rows(7)
                            ->required(),

                        Forms\Components\Textarea::make('mission')
                            ->label('Mission')
                            ->placeholder('Enter the mission of Life International School...')
                            ->helperText('Describe the mission and purpose of the school.')
                            ->rows(7)
                            ->required(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Founder Message
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Message from the Founder')
                    ->description('Manage the founder image, message, blessing, and name.')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\FileUpload::make('founder_image')
                            ->label('Founder Image')
                            ->helperText('Recommended: portrait JPG, PNG, or WebP image, up to 5MB.')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->directory('history/founder')
                            ->imageEditor()
                            ->imagePreviewHeight('280')
                            ->panelLayout('integrated')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->columnSpanFull(), 

                        Forms\Components\TextInput::make('founder_name')
                            ->label('Founder Name')
                            ->default('— From The Founder: Rev. Dr. David Koo')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-user'), 

                        Forms\Components\TextInput::make('founder_blessing')
                            ->label('Blessing Text')
                            ->default('May The Lord’s Grace And Peace Be With You All.')
                            ->maxLength(255)
                            ->prefixIcon('heroicon-m-sparkles'), 

                        Forms\Components\Textarea::make('founder_message')
                            ->label('Founder Message')
                            ->placeholder('Enter the founder’s message...')
                            ->helperText('This message will be displayed beside the founder image.')
                            ->rows(6) 
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('founder_image')
                    ->label('Founder')
                    ->circular()
                    ->height(55)
                    ->ring(2), 

                Tables\Columns\TextColumn::make('vision')
                    ->label('Vision')
                    ->limit(45)
                    ->wrap()
                    ->icon('heroicon-m-eye') 
                    ->iconColor('primary')
                    ->tooltip(
                        fn (HistorySetting $record): ?string =>
                            strlen($record->vision ?? '') > 45 ? $record->vision : null
                    ),

                Tables\Columns\TextColumn::make('mission')
                    ->label('Mission')
                    ->limit(45)
                    ->wrap()
                    ->icon('heroicon-m-flag') 
                    ->iconColor('success')
                    ->tooltip(
                        fn (HistorySetting $record): ?string =>
                            strlen($record->mission ?? '') > 45 ? $record->mission : null
                    ),

                Tables\Columns\TextColumn::make('banner_slider')
                    ->label('Total Slides')
                    ->state(
                        fn (HistorySetting $record): int =>
                            is_array($record->banner_slider) ? count($record->banner_slider) : 0
                    )
                    ->badge()
                    ->color('warning')
                    ->icon('heroicon-m-photo'), 

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->badge() 
                    ->color('gray')
                    ->icon('heroicon-m-clock')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()->button(), 
                Tables\Actions\DeleteAction::make()->button(), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No history settings found')
            ->emptyStateDescription('Create a history setting to manage the History & Governance page.')
            ->emptyStateIcon('heroicon-o-clock');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHistorySettings::route('/'),
            'create' => Pages\CreateHistorySetting::route('/create'),
            'edit' => Pages\EditHistorySetting::route('/{record}/edit'),
        ];
    }
}
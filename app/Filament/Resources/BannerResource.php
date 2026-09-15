<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationGroup = 'Website Content';

    protected static ?string $navigationLabel = 'Banners';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Banner Content')
                    ->description(
                        'Set the slogan displayed in the homepage banner.'
                    )
                    ->icon('heroicon-o-megaphone')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Banner Slogan')
                            ->placeholder('Truth | Integrity | Love')
                            ->helperText(
                                'Use the | symbol to separate each phrase.'
                            )
                            ->prefixIcon('heroicon-o-pencil-square')
                            ->required()
                            ->maxLength(100)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Images and Video')
                    ->description(
                        'The feature image appears on the right, while the video is used as the background.'
                    )
                    ->icon('heroicon-o-film')
                    ->schema([

                        Forms\Components\FileUpload::make('image')
                            ->label('Feature Image')
                            ->disk('s3')
                            ->helperText(
                                'Recommended size: 1200 × 900px. JPG, PNG, or WebP, up to 5MB.'
                            )
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->directory('banner-images')
                            ->imageEditor()
                            ->imagePreviewHeight('260')
                            ->panelLayout('integrated')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->required(),

                        Forms\Components\FileUpload::make('video')
                            ->label('Background Video')
                            ->disk('s3')
                            ->visibility('public')
                            ->fetchFileInformation(false)
                            ->helperText(
                                'Use MP4 or WebM. Video size can be up to 100MB.'
                            )
                            ->acceptedFileTypes([
                                'video/mp4',
                                'video/webm',
                                'video/quicktime',
                            ])
                            ->directory('banners/videos')
                            ->previewable(false)
                            ->openable()
                            ->downloadable()
                            ->maxSize(102400) // 102400 KB = 100MB
                            ->columnSpanFull(),

                    ])
                    ->columns(2)
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('s3')
                    ->height(65),

                Tables\Columns\TextColumn::make('title')
                    ->label('Slogan')
                    ->searchable()
                    ->wrap()
                    ->limit(60)
                    ->tooltip(
                        fn (Tables\Columns\TextColumn $column): ?string =>
                            strlen($column->getState()) > 60
                                ? $column->getState()
                                : null
                    ),

                Tables\Columns\IconColumn::make('video')
                    ->label('Video')
                    ->state(
                        fn (Banner $record): bool => filled($record->video)
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
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
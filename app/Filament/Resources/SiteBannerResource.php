<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteBannerResource\Pages;
use App\Models\SiteBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SiteBannerResource extends Resource
{
    protected static ?string $model = SiteBanner::class;

    protected static ?string $navigationGroup = 'Website Content';

    protected static ?string $modelLabel = 'Site Banner';
    protected static ?string $pluralModelLabel = 'Site Banners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        // ផ្នែកខាងឆ្វេង (Banner Information)
                        Group::make()
                            ->schema([
                                Section::make('Banner Information')
                                    ->description('Specify which page this banner belongs to')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        TextInput::make('page_name')
                                            ->label('📄 Page Name')
                                            ->placeholder('e.g., Contact, Admissions, Home...')
                                            ->prefixIcon('heroicon-o-document-text')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ផ្នែកខាងស្តាំ (Media Upload - Cloudflare R2)
                        Group::make()
                            ->schema([
                                Section::make('Banner Images / Slideshow')
                                    ->description('Upload high-quality banner images for slider')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label('🖼️ Upload Banners')
                                            ->disk('s3') // 📍 បញ្ជូនទៅ Cloudflare R2
                                            ->visibility('public')
                                            ->fetchFileInformation(false)
                                            ->multiple() // 📍 Upload បានច្រើនសន្លឹក
                                            ->reorderable() // 📍 អូសរៀបលំដាប់រូបភាពបាន
                                            ->image()
                                            ->directory('site-banners')
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(51200) // 50MB ក្នុងមួយរូប
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('🖼️ Banners')
                    ->disk('s3')
                    ->circular()
                    ->stacked()
                    ->limit(3),

                TextColumn::make('page_name')
                    ->label('📄 Page Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('created_at')
                    ->label('📅 Created Date')
                    ->dateTime('d M Y, h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->badge()
                    ->color('success'),
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
            'index' => Pages\ListSiteBanners::route('/'),
            'create' => Pages\CreateSiteBanner::route('/create'),
            'edit' => Pages\EditSiteBanner::route('/{record}/edit'),
        ];
    }
}
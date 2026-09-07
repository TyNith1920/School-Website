<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteBannerResource\Pages;
use App\Models\SiteBanner;
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
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class SiteBannerResource extends Resource
{
    protected static ?string $model = SiteBanner::class;

    protected static ?string $navigationGroup = 'Website Content';

    // 📍 កំណត់ឈ្មោះនៅលើ Menu ឱ្យចេញជាភាសាអង់គ្លេសស្អាត
    protected static ?string $modelLabel = 'Site Banner';
    protected static ?string $pluralModelLabel = 'Site Banners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Banner Info)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Banner Information')
                                    ->description('Specify which page this banner belongs to')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        TextInput::make('page_name')
                                            ->label('📄 Page Name')
                                            ->placeholder('e.g., Contact Us, Admissions...')
                                            ->prefixIcon('heroicon-o-document-text')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Media Upload)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Banner Image')
                                    ->description('Upload a high-quality banner image')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label('🖼️ Upload Banner')
                                            ->image()
                                            ->directory('banners')
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
                    ->label('🖼️ Banner')
                    ->height(50) // កំណត់កម្ពស់ឱ្យល្មម
                    ->extraImgAttributes(['class' => 'object-cover rounded-md']), // ធ្វើឱ្យរូបចេញជារាងចតុកោណកែងស្អាតដូច Banner ពិតៗ

                TextColumn::make('page_name')
                    ->label('📄 Page Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('created_at')
                    ->label('📅 Created Date')
                    ->dateTime('d M Y') // ទម្រង់ថ្ងៃខែ (ឧទាហរណ៍: 21 Aug 2026)
                    ->sortable()
                    ->badge(),
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
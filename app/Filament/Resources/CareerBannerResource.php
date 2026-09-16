<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerBannerResource\Pages;
use App\Models\CareerBanner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class CareerBannerResource extends Resource
{
    protected static ?string $model = CareerBanner::class;

    protected static ?string $navigationGroup = 'Admissions & Careers';

    protected static ?string $modelLabel = 'Career Banner';
    protected static ?string $pluralModelLabel = 'Career Banners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Banner Settings')
                    ->description('Upload the main banner image for the careers page')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('image')
                            ->label('🖼️ Banner Image')
                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                            ->visibility('public') // 📍 បើក Public URL
                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំង UI ពេល Edit
                            ->image()
                            ->directory('career-banners')
                            ->openable()
                            ->downloadable()
                            ->maxSize(15360) // 15MB
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('🖼️ Banner Image')
                    ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                    ->height(60) 
                    ->extraImgAttributes(['class' => 'object-contain']), 

                TextColumn::make('updated_at')
                    ->label('⏱️ Last Updated')
                    ->dateTime('d M Y, h:i A') 
                    ->timezone('Asia/Phnom_Penh')
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
            'index' => Pages\ListCareerBanners::route('/'),
            'create' => Pages\CreateCareerBanner::route('/create'),
            'edit' => Pages\EditCareerBanner::route('/{record}/edit'),
        ];
    }
}
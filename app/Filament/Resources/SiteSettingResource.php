<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
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
use Filament\Tables\Columns\TextColumn;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationGroup = 'Website Content';

    // 📍 កំណត់ឈ្មោះនៅលើ Menu ឱ្យចេញជាភាសាអង់គ្លេសស្អាត
    protected static ?string $modelLabel = 'Global Setting';
    protected static ?string $pluralModelLabel = 'Global Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Social Media Links)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Social Media Links')
                                    ->description('Manage your official social media profiles')
                                    ->icon('heroicon-o-globe-alt')
                                    ->schema([
                                        TextInput::make('facebook')
                                            ->label('📘 Facebook Link')
                                            ->prefixIcon('heroicon-o-link')
                                            ->url()
                                            ->placeholder('https://facebook.com/...')
                                            ->columnSpanFull(),
                                            
                                        TextInput::make('instagram')
                                            ->label('📸 Instagram Link')
                                            ->prefixIcon('heroicon-o-link')
                                            ->url()
                                            ->placeholder('https://instagram.com/...')
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Email Contact)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Contact Detail')
                                    ->description('Primary email for the website')
                                    ->icon('heroicon-o-envelope')
                                    ->schema([
                                        TextInput::make('email')
                                            ->label('📧 Email Address')
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->email()
                                            ->placeholder('info@life.edu.kh')
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
                TextColumn::make('email')
                    ->label('📧 Email Address')
                    ->searchable()
                    ->weight('bold'),
                    
                TextColumn::make('facebook')
                    ->label('📘 Facebook')
                    ->limit(35)
                    ->color('primary'), 
                    
                TextColumn::make('instagram')
                    ->label('📸 Instagram')
                    ->limit(35)
                    ->color('primary'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
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
            'index' => Pages\ListSiteSettings::route('/'),
            'create' => Pages\CreateSiteSetting::route('/create'),
            'edit' => Pages\EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
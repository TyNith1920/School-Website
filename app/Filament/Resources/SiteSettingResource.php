<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// 📍 Import Components
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static ?string $navigationGroup = 'Website Content';

    protected static ?string $modelLabel = 'Global Setting';
    protected static ?string $pluralModelLabel = 'Global Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([

                        // ==============================================
                        // ផ្នែកខាងលើ៖ Top Announcement Marquee Bar (អក្សររត់ខាងលើបង្អស់)
                        // ==============================================
                        Section::make('📢 Top Announcement Bar (ខ្សែបន្ទាត់អក្សររត់ខាងលើបង្អស់)')
                            ->description('កំណត់ និងគ្រប់គ្រងអក្សររត់ផ្ដល់ដំណឹងបន្ទាន់នៅពីលើ Header គេហទំព័រ')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Toggle::make('show_announcement')
                                    ->label('បង្ហាញខ្សែបន្ទាត់អក្សររត់ (Show/Hide Marquee)')
                                    ->helperText('បើកដើម្បីបង្ហាញនៅលើគេហទំព័រ ឬបិទនៅពេលគ្មានដំណឹង')
                                    ->default(true),

                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('announcement_badge')
                                            ->label('🏷️ ស្លាកពាក្យ (Badge Label)')
                                            ->placeholder('ANNOUNCEMENT ឬ FLASH NEWS')
                                            ->default('ANNOUNCEMENT')
                                            ->maxLength(50),

                                        TextInput::make('announcement_text')
                                            ->label('📝 ខ្លឹមសារអក្សររត់ (Marquee Text)')
                                            ->placeholder('Welcome to Life International School! Admissions are now open...')
                                            ->required()
                                            ->columnSpanFull(),
                                    ]),
                            ])
                            ->columnSpanFull(),

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
                IconColumn::make('show_announcement')
                    ->label('Marquee Active')
                    ->boolean(),

                TextColumn::make('announcement_text')
                    ->label('📢 Announcement Text')
                    ->limit(45)
                    ->tooltip(fn ($record) => $record->announcement_text),

                TextColumn::make('email')
                    ->label('📧 Email Address')
                    ->searchable()
                    ->weight('bold'),

                TextColumn::make('facebook')
                    ->label('📘 Facebook')
                    ->limit(25)
                    ->color('primary'),

                TextColumn::make('instagram')
                    ->label('📸 Instagram')
                    ->limit(25)
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
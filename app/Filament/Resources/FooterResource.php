<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterResource\Pages;
use App\Models\Footer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class FooterResource extends Resource
{
    protected static ?string $model = Footer::class;

    protected static ?string $navigationGroup = 'Website Content';

    protected static ?string $modelLabel = 'Footer Setting';
    protected static ?string $pluralModelLabel = 'Footer Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Group::make()
                            ->schema([
                                Section::make('Contact & Location')
                                    ->description('Set up phone numbers, telegram, email, and address')
                                    ->icon('heroicon-o-map-pin')
                                    ->schema([
                                        TextInput::make('phone')
                                            ->label('📞 Phone Number')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->required(),

                                        TextInput::make('telegram')
                                            ->label('✈️ Telegram Number')
                                            ->prefixIcon('heroicon-o-paper-airplane')
                                            ->required(),

                                        TextInput::make('email')
                                            ->label('📧 Email Address')
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->email()
                                            ->required()
                                            ->columnSpanFull(),

                                        Textarea::make('address')
                                            ->label('📍 School Address')
                                            ->placeholder('Enter the physical address here...')
                                            ->rows(3)
                                            ->columnSpanFull(),
                                    ])->columns(2),

                                Section::make('Office Hours')
                                    ->description('Display the working hours on the website footer')
                                    ->icon('heroicon-o-clock')
                                    ->schema([
                                        TextInput::make('weekdays_time')
                                            ->label('🗓️ Weekdays (Mon - Fri)')
                                            ->prefixIcon('heroicon-o-calendar-days')
                                            ->required(),

                                        TextInput::make('weekend_time')
                                            ->label('🗓️ Weekend (Saturday)')
                                            ->prefixIcon('heroicon-o-calendar')
                                            ->required(),
                                    ])->columns(2),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        Group::make()
                            ->schema([
                                Section::make('Telegram QR Code')
                                    ->description('Upload the Telegram QR for easy scanning')
                                    ->icon('heroicon-o-qr-code')
                                    ->schema([
                                        FileUpload::make('telegram_qr')
                                            ->label('📱 Telegram QR')
                                            ->image()
                                            ->disk('s3')
                                            ->visibility('public')
                                            ->fetchFileInformation(false) 
                                            ->directory('footers/qr')
                                            ->columnSpanFull(),
                                    ]),

                                Section::make('Accreditations & Logos')
                                    ->description('Upload partner or accreditation logos')
                                    ->icon('heroicon-o-shield-check')
                                    ->schema([
                                        FileUpload::make('logos_image')
                                            ->label('🏆 Partner Logos')
                                            ->image()
                                            ->disk('s3')
                                            ->visibility('public')
                                            ->fetchFileInformation(false) 
                                            ->directory('footers/logos')
                                            ->multiple()
                                            ->panelLayout('grid')
                                            ->reorderable(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('phone')
                    ->label('📞 Phone')
                    ->searchable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('email')
                    ->label('📧 Email')
                    ->searchable(),
                    
                ImageColumn::make('telegram_qr')
                    ->label('📱 QR Code')
                    ->disk('s3') // ទាញរូបពី Cloudflare R2
                    ->circular(),

                TextColumn::make('weekdays_time')
                    ->label('🕒 Weekdays')
                    ->badge()
                    ->color('success'), 

                ImageColumn::make('logos_image')
                    ->label('🏆 Logos')
                    ->disk('s3') // ទាញរូបពី Cloudflare R2
                    ->circular()
                    ->stacked()
                    ->limit(3),
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
            'index' => Pages\ListFooters::route('/'),
            'create' => Pages\CreateFooter::route('/create'),
            'edit' => Pages\EditFooter::route('/{record}/edit'),
        ];
    }
}
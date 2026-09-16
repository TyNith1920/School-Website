<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentPageResource\Pages;
use App\Models\EnrollmentPage;
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

class EnrollmentPageResource extends Resource
{
    protected static ?string $model = EnrollmentPage::class;

    protected static ?string $navigationGroup = 'Admissions & Careers';

    protected static ?string $modelLabel = 'Enrollment Page';
    protected static ?string $pluralModelLabel = 'Enrollment Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        Group::make()
                            ->schema([
                                Section::make('Hero Section')
                                    ->description('Main heading displayed at the top of the page')
                                    ->icon('heroicon-o-sparkles')
                                    ->schema([
                                        TextInput::make('hero_title')
                                            ->label('🌟 Hero Title')
                                            ->prefixIcon('heroicon-o-bookmark')
                                            ->required(),
                                            
                                        TextInput::make('hero_subtitle')
                                            ->label('📝 Hero Subtitle')
                                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text'),
                                    ]),

                                Section::make('Page Content')
                                    ->description('Information about the enrollment process')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        TextInput::make('section_title')
                                            ->label('📑 Section Title')
                                            ->prefixIcon('heroicon-o-bars-3-bottom-left')
                                            ->required(),
                                            
                                        Textarea::make('section_description')
                                            ->label('✍️ Section Description')
                                            ->rows(5)
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        Group::make()
                            ->schema([
                                Section::make('Media & Attachments')
                                    ->description('Upload images and enrollment PDF files')
                                    ->icon('heroicon-o-folder-open')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('🖼️ Featured Image')
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 អនុញ្ញាត Public Read
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->image()
                                            ->directory('enrollment/images')
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(10240) // 10MB
                                            ->required(),
                                            
                                        FileUpload::make('pdf_file')
                                            ->label('📄 Enrollment Form (PDF)')
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 អនុញ្ញាត Public Read
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('enrollment/pdfs')
                                            ->downloadable()
                                            ->openable()
                                            ->maxSize(51200), // 50MB
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),
                            
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('🖼️ Image')
                    ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                    ->circular(),

                TextColumn::make('hero_title')
                    ->label('🌟 Hero Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->limit(30),

                TextColumn::make('section_title')
                    ->label('📑 Section Title')
                    ->searchable()
                    ->limit(30),

                TextColumn::make('updated_at')
                    ->label('⏱️ Last Updated')
                    ->dateTime('d M Y, h:i A')
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
            'index' => Pages\ListEnrollmentPages::route('/'),
            'create' => Pages\CreateEnrollmentPage::route('/create'),
            'edit' => Pages\EditEnrollmentPage::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnrollmentPageResource\Pages;
use App\Models\EnrollmentPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// 📍 Import មុខងារ Layout និង Components
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

    // 📍 កំណត់ឈ្មោះនៅលើ Menu ឱ្យចេញជាភាសាអង់គ្លេសស្អាត
    protected static ?string $modelLabel = 'Enrollment Page';
    protected static ?string $pluralModelLabel = 'Enrollment Pages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Text Content)
                        // ==============================================
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

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Media & Files)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Media & Attachments')
                                    ->description('Upload images and enrollment PDF files')
                                    ->icon('heroicon-o-folder-open')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('🖼️ Featured Image')
                                            ->image()
                                            ->directory('enrollment')
                                            ->required(),
                                            
                                        FileUpload::make('pdf_file')
                                            ->label('📄 Enrollment Form (PDF)')
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('enrollment/pdfs'),
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
                Tables\Actions\DeleteAction::make()->button(), // 📍 ថែមប៊ូតុង Delete ឱ្យកុំឱ្យខ្វះ
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
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
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
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationGroup = 'Website Content';

    // 📍 កំណត់ឈ្មោះនៅលើ Menu ឱ្យចេញជាភាសាអង់គ្លេសស្អាត
    protected static ?string $modelLabel = 'News & Event';
    protected static ?string $pluralModelLabel = 'News & Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (News Details)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Article Information')
                                    ->description('Enter the title and full details of the news or event')
                                    ->icon('heroicon-o-newspaper')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('🏷️ Title')
                                            ->prefixIcon('heroicon-o-bookmark')
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('link')
                                            ->label('🔗 Facebook / Reference Link')
                                            ->prefixIcon('heroicon-o-link')
                                            ->placeholder('https://facebook.com/...')
                                            ->url(),

                                        // 📍 ប្រើ RichEditor ជំនួស Textarea ដើម្បីឱ្យ Admin អាចលេងស្ទាយអក្សរបាន
                                        RichEditor::make('description')
                                            ->label('📝 Content Details')
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'strike',
                                                'bulletList', 'orderedList', 'link', 'redo', 'undo',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Media)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Media')
                                    ->description('Upload the featured image')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('🖼️ Featured Image')
                                            ->image()
                                            ->directory('news-images')
                                            ->required() // គួរតែតម្រូវឱ្យមានរូបភាពជានិច្ច
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
                ImageColumn::make('image')
                    ->label('🖼️ Image')
                    ->circular(), // ធ្វើឱ្យរូបភាពចេញជារង្វង់មូល

                TextColumn::make('title')
                    ->label('🏷️ Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->limit(40), // កាត់អត្ថបទបើវែងពេកកុំឱ្យខូចតារាង

                TextColumn::make('link')
                    ->label('🔗 Link')
                    ->limit(20)
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('📅 Posted Date')
                    ->dateTime('d M Y, h:i A') // ទម្រង់ថ្ងៃខែស្អាត
                    ->sortable()
                    ->badge()
                    ->color('success'), // ប្រអប់ពណ៌បៃតង
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
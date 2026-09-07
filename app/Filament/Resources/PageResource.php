<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// 📍 Import មុខងារសំខាន់ៗ
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationGroup = 'Website Content';

    // 📍 ១. កំណត់ឈ្មោះដែលត្រូវបង្ហាញនៅលើ Menu ខាងឆ្វេងផ្ទាល់ (Sidebar Menu)
    protected static ?string $navigationLabel = 'Academics Pages';

    // 📍 ២. កំណត់ឈ្មោះពេលបង្ហាញឯកវចនៈ (ឧ. លោតត្រង់ប៊ូតុង "New Academics Page")
    protected static ?string $modelLabel = 'Academics Page';

    // 📍 ៣. កំណត់ឈ្មោះពេលបង្ហាញពហុវចនៈ (ឧ. លោតនៅខាងលើក្បាលតារាង)
    protected static ?string $pluralModelLabel = 'Academics Pages';
    
    // ... កូដផ្សេងៗនៅខាងក្រោមរក្សាទុកដដែល ...
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Content & SEO)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Page Content')
                                    ->description('Create the main content and auto-generate the URL slug')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('🏷️ Page Title')
                                            ->prefixIcon('heroicon-o-bookmark')
                                            ->required()
                                            ->live(onBlur: true)
                                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))), 
                                        
                                        TextInput::make('slug')
                                            ->label('🔗 URL Slug')
                                            ->prefixIcon('heroicon-o-link')
                                            ->required()
                                            ->unique(ignoreRecord: true),
                                        
                                        RichEditor::make('content')
                                            ->label('📝 Full Content')
                                            ->required()
                                            ->toolbarButtons([
                                                'bold', 'italic', 'underline', 'strike',
                                                'bulletList', 'orderedList', 'link', 'redo', 'undo', 'h2', 'h3'
                                            ])
                                            ->columnSpanFull(),
                                    ])->columns(2), // ដាក់ Title និង Slug ទន្ទឹមគ្នាជា ២ ជួរ
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Media)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Media & Gallery')
                                    ->description('Upload a cover image and multiple gallery photos')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('🖼️ Cover Image')
                                            ->image()
                                            ->directory('pages-images')
                                            ->columnSpanFull(),

                                        FileUpload::make('gallery')
                                            ->label('📸 Gallery (Multiple)')
                                            ->image()
                                            ->multiple()
                                            ->panelLayout('grid') 
                                            ->directory('pages/gallery')
                                            ->reorderable()
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
                    ->label('🖼️ Cover')
                    ->circular(),

                TextColumn::make('title')
                    ->label('🏷️ Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('slug')
                    ->label('🔗 Slug')
                    ->searchable()
                    ->color('gray'),

                // 📍 បង្ហាញរូប Gallery ត្រួតៗគ្នាស្អាតក្នុងតារាង
                ImageColumn::make('gallery')
                    ->label('📸 Gallery')
                    ->circular()
                    ->stacked()
                    ->limit(3),

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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
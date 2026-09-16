<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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

    protected static ?string $navigationLabel = 'Academics Pages';

    protected static ?string $modelLabel = 'Academics Page';

    protected static ?string $pluralModelLabel = 'Academics Pages';
    
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
                                    ])->columns(2),
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
                                        // 🖼️ Cover Image
                                        FileUpload::make('image')
                                            ->label('🖼️ Cover Image')
                                            ->image()
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 បើក Public URL
                                            ->directory('pages-images')
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(10240) // 10MB
                                            ->columnSpanFull(),

                                        // 📸 Gallery (Multiple)
                                        FileUpload::make('gallery')
                                            ->label('📸 Gallery (Multiple)')
                                            ->image()
                                            ->multiple()
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 បើក Public URL
                                            ->panelLayout('grid') 
                                            ->directory('pages/gallery')
                                            ->reorderable()
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(10240) // 10MB ក្នុងមួយរូប
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
                    ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                    ->circular()
                    ->height(50),

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

                ImageColumn::make('gallery')
                    ->label('📸 Gallery')
                    ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
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
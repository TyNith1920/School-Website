<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
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

    protected static ?string $modelLabel = 'News & Event';
    protected static ?string $pluralModelLabel = 'News & Events';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                    ->schema([
                        // ==============================================
                        // ផ្នែកទី ១៖ Article Information (ព័ត៌មានអត្ថបទ)
                        // ==============================================
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

                                RichEditor::make('description')
                                    ->label('📝 Content Details')
                                    ->toolbarButtons([
                                        'bold', 'italic', 'underline', 'strike',
                                        'bulletList', 'orderedList', 'link', 'redo', 'undo', 'h2', 'h3'
                                    ])
                                    ->columnSpanFull(),
                            ]),

                        // ==============================================
                        // ផ្នែកទី ២៖ Media Gallery (រៀបជា Grid Thumbnail ស្អាត)
                        // ==============================================
                        Section::make('Media Gallery')
                            ->description('Upload images (Single or Multiple) - Automatically organized in grid thumbnails')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                FileUpload::make('image')
                                    ->label('🖼️ News Images / Gallery')
                                    ->disk('s3') // Cloudflare R2
                                    ->visibility('public')
                                    ->fetchFileInformation(false)
                                    ->multiple() // 📍 Upload រូបភាពបានច្រើនសន្លឹក
                                    ->reorderable() // 📍 អូសរៀបលំដាប់រូបភាពបាន
                                    ->image()
                                    ->panelLayout('grid') // 📍 បង្ខំឱ្យរៀបជា Grid មិនធ្លាក់ចុះក្រោមវែងអន្លាយ
                                    ->imagePreviewHeight('150') // 📍 កម្រិតកម្ពស់រូប Thumbnail ឱ្យតូចល្មមស្អាត
                                    ->directory('news-images')
                                    ->openable()
                                    ->downloadable()
                                    ->maxSize(15360) // 15MB ក្នុងមួយរូប
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('🖼️ Image')
                    ->disk('s3')
                    ->circular()
                    ->stacked()
                    ->limit(3), 

                TextColumn::make('title')
                    ->label('🏷️ Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->limit(40), 

                TextColumn::make('link')
                    ->label('🔗 Link')
                    ->limit(20)
                    ->color('gray'),

                TextColumn::make('created_at')
                    ->label('📅 Posted Date')
                    ->dateTime('d M Y, h:i A') 
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->badge()
                    ->color('success'), 
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
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentLifeResource\Pages;
use App\Models\StudentLife;
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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class StudentLifeResource extends Resource
{
    protected static ?string $model = StudentLife::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $modelLabel = 'Student Life';
    protected static ?string $pluralModelLabel = 'Student Life';
    protected static ?string $navigationLabel = 'Student Life';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (General Information)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('General Information')
                                    ->description('Enter the title, description, and related link')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('🏷️ Title')
                                            ->prefixIcon('heroicon-o-bookmark')
                                            ->required(),
                                            
                                        TextInput::make('link')
                                            ->label('🔗 Link (Action Button or Facebook)')
                                            ->prefixIcon('heroicon-o-link')
                                            ->url(),
                                            
                                        Textarea::make('description')
                                            ->label('📝 Description')
                                            ->rows(6)
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Media)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Media')
                                    ->description('Upload cover image and photo gallery')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('🖼️ Cover Image')
                                            ->image()
                                            ->directory('student-life-images')
                                            ->required(),

                                        FileUpload::make('gallery_images')
                                            ->label('📸 Gallery Images (Multiple)')
                                            ->image()
                                            ->multiple()
                                            ->panelLayout('grid')
                                            ->directory('student-life-gallery')
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
                ImageColumn::make('image')
                    ->label('🖼️ Cover')
                    ->circular(),

                TextColumn::make('title')
                    ->label('🏷️ Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                ImageColumn::make('gallery_images')
                    ->label('📸 Gallery')
                    ->circular()
                    ->stacked() // បង្ហាញរូបត្រួតៗគ្នាស្អាត
                    ->limit(3), // កំណត់បង្ហាញត្រឹម ៣ រូប

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
            'index' => Pages\ListStudentLives::route('/'),
            'create' => Pages\CreateStudentLife::route('/create'),
            'edit' => Pages\EditStudentLife::route('/{record}/edit'),
        ];
    }
}
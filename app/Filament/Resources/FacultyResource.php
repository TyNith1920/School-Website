<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacultyResource\Pages;
use App\Models\Faculty;
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
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class FacultyResource extends Resource
{
    protected static ?string $model = Faculty::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3) // បែងចែកអេក្រង់ជា ៣ ចំណែក
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (General Information)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Faculty Information')
                                    ->description('Enter the staff member\'s personal details')
                                    ->icon('heroicon-o-user')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('👤 Name')
                                            ->prefixIcon('heroicon-o-user')
                                            ->required()
                                            ->maxLength(255),

                                        TextInput::make('position')
                                            ->label('💼 Position')
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->required()
                                            ->maxLength(255),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Profile & Settings)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Profile & Settings')
                                    ->description('Upload image and set ordering')
                                    ->icon('heroicon-o-cog-8-tooth')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->label('📸 Profile Image')
                                            ->disk('s3') // កំណត់ទៅ Cloudflare R2
                                            ->fetchFileInformation(false)
                                            ->image()
                                            ->directory('faculties')
                                            ->maxSize(10240) // កំណត់ត្រឹម 10MB
                                            ->helperText('Allowed format: JPG, PNG, WebP up to 10MB'),

                                        TextInput::make('sort_order')
                                            ->label('🔢 Sort Order')
                                            ->prefixIcon('heroicon-o-hashtag')
                                            ->numeric()
                                            ->default(0),
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
                    ->label('📸 Image')
                    ->disk('s3') // ទាញរូបពី Cloudflare R2
                    ->circular(),

                TextColumn::make('name')
                    ->label('👤 Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('position')
                    ->label('💼 Position')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('🔢 Sort Order')
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
            'index' => Pages\ListFaculties::route('/'),
            'create' => Pages\CreateFaculty::route('/create'),
            'edit' => Pages\EditFaculty::route('/{record}/edit'),
        ];
    }
}
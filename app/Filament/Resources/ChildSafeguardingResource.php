<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChildSafeguardingResource\Pages;
use App\Models\ChildSafeguarding;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class ChildSafeguardingResource extends Resource
{
    protected static ?string $model = ChildSafeguarding::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ផ្នែកខាងឆ្វេង (General Information)
                        Group::make()
                            ->schema([
                                Section::make('General Information')
                                    ->description('Enter the title and detailed information here')
                                    ->icon('heroicon-o-information-circle')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('🏷️ Title')
                                            ->prefixIcon('heroicon-o-bookmark')
                                            ->required(),
                                            
                                        Textarea::make('description')
                                            ->label('📝 Description')
                                            ->rows(6),
                                            
                                        Textarea::make('video_url')
                                            ->label('🎥 Video iframe (YouTube/Facebook)')
                                            ->rows(3),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ផ្នែកខាងស្តាំ (Attachments)
                        Group::make()
                            ->schema([
                                Section::make('Attachments')
                                    ->description('Upload PDF and image files here')
                                    ->icon('heroicon-o-paper-clip')
                                    ->schema([
                                        FileUpload::make('pdf_file')
                                            ->label('📄 Policy Document (PDF)')
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 បើក Public URL
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->acceptedFileTypes(['application/pdf'])
                                            ->directory('safeguarding-pdfs')
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(51200), // 50MB
                                            
                                        FileUpload::make('images')
                                            ->label('🖼️ Images')
                                            ->disk('s3') // 📍 ប្ដូរទៅ Cloudflare R2
                                            ->visibility('public') // 📍 បើក Public URL
                                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យគាំងពេល Edit
                                            ->image()
                                            ->multiple() 
                                            ->panelLayout('grid') 
                                            ->directory('safeguarding-images')
                                            ->reorderable()
                                            ->openable()
                                            ->downloadable()
                                            ->maxSize(20480), // 20MB
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('🏷️ Title')
                    ->searchable() 
                    ->sortable() 
                    ->weight('bold') 
                    ->color('primary'),
                    
                ImageColumn::make('images')
                    ->label('🖼️ Images')
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
                Tables\Actions\EditAction::make()
                    ->button(), 
                Tables\Actions\DeleteAction::make()
                    ->button(), 
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
            'index' => Pages\ListChildSafeguardings::route('/'),
            'create' => Pages\CreateChildSafeguarding::route('/create'),
            'edit' => Pages\EditChildSafeguarding::route('/{record}/edit'),
        ];
    }
}
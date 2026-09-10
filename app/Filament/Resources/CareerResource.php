<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Models\Career;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationGroup = 'Admissions & Careers';

    protected static ?string $modelLabel = 'Career Opening';
    protected static ?string $pluralModelLabel = 'Careers';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Job Details)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Job Details')
                                    ->description('Enter the core information about this position')
                                    ->icon('heroicon-o-briefcase')
                                    ->schema([
                                        TextInput::make('title')
                                            ->label('🏷️ Job Title')
                                            ->prefixIcon('heroicon-o-briefcase')
                                            ->required(),
                                            
                                        Select::make('job_type')
                                            ->label('💼 Job Type')
                                            ->prefixIcon('heroicon-o-clipboard-document-list')
                                            ->options([
                                                'Full-Time' => 'Full-Time',
                                                'Part-Time' => 'Part-Time',
                                                'Contract' => 'Contract',
                                            ])
                                            ->default('Full-Time')
                                            ->required(),

                                        RichEditor::make('description')
                                            ->label('📝 Job Description')
                                            ->columnSpanFull(),
                                    ])->columns(2), 
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Application & Status)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Application & Status')
                                    ->description('Set hiring status and attach forms')
                                    ->icon('heroicon-o-document-check')
                                    ->schema([
                                        Toggle::make('is_active')
                                            ->label('🟢 Open for Hiring (Active)')
                                            ->default(true),

                                        FileUpload::make('application_file')
                                            ->label('📄 Application Form (PDF)')
                                            ->disk('public') // 📍 រក្សាទុក PDF ក្នុង Local Public Disk ដូចទំព័រ Enrollment
                                            ->directory('careers-files')
                                            ->acceptedFileTypes(['application/pdf']),
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
                    ->label('🏷️ Job Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('job_type')
                    ->label('💼 Job Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Full-Time' => 'success', 
                        'Part-Time' => 'warning', 
                        'Contract' => 'info',    
                        default => 'primary',
                    }),

                IconColumn::make('is_active')
                    ->label('🟢 Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                TextColumn::make('created_at')
                    ->label('📅 Posted Date')
                    ->dateTime('d M Y') 
                    ->sortable(),
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
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }
}
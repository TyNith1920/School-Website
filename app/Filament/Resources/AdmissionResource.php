<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdmissionResource\Pages;
use App\Models\Admission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AdmissionResource extends Resource
{
    protected static ?string $model = Admission::class;

    protected static ?string $navigationGroup = 'Admissions & Careers';

    protected static ?string $navigationLabel = 'Admissions';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*
                |--------------------------------------------------------------------------
                | Admission Content
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Admission Content')
                    ->description('Manage the title and description displayed in the admissions section.')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Admissions')
                            ->prefixIcon('heroicon-o-pencil-square')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Describe the admissions process and guide visitors on how to apply.')
                            ->helperText('Keep the description short and clear for website visitors.')
                            ->rows(4)
                            ->required()
                            ->maxLength(500)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                /*
                |--------------------------------------------------------------------------
                | Application Button and Form (PDF)
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Application Button and Form')
                    ->description('Configure the application button and upload the admission form.')
                    ->icon('heroicon-o-document-arrow-down')
                    ->schema([
                        Forms\Components\TextInput::make('button_text')
                            ->label('Button Text')
                            ->placeholder('Apply Now')
                            ->default('Apply Now')
                            ->prefixIcon('heroicon-o-cursor-arrow-rays')
                            ->helperText('This text appears on the application button.')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\FileUpload::make('button_link')
                            ->label('Application Form (PDF)')
                            ->helperText('Upload a PDF admission form, up to 20MB.')
                            ->disk('s3') // 📍 បញ្ជូនទៅ Cloudflare R2
                            ->visibility('public')
                            ->directory('admission-forms')
                            ->acceptedFileTypes([
                                'application/pdf',
                            ])
                            ->previewable(false)
                            ->openable()
                            ->downloadable()
                            ->maxSize(20480),
                    ])
                    ->columns(2)
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Feature Image (រូបភាព)
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Feature Image')
                    ->description('Upload the image displayed on the right side of the admissions section.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Admission Feature Image')
                            ->helperText('Recommended: square image, at least 1200 × 1200px. JPG, PNG, or WebP.')
                            ->disk('s3') // 📍 បញ្ជូនទៅ Cloudflare R2
                            ->visibility('public')
                            ->image()
                            ->directory('admissions')
                            ->imagePreviewHeight('280')
                            ->openable()
                            ->downloadable()
                            ->maxSize(20480)
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('s3') // 📍 ទាញយករូបភាពពី Cloudflare R2 មកបង្ហាញ (លែងបាក់រូប)
                    ->height(65)
                    ->extraImgAttributes([
                        'class' => 'object-cover rounded-lg',
                    ]),

                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(60)
                    ->wrap()
                    ->tooltip(
                        fn (Tables\Columns\TextColumn $column): ?string =>
                            strlen($column->getState()) > 60
                                ? $column->getState()
                                : null
                    ),

                Tables\Columns\TextColumn::make('button_text')
                    ->label('Button')
                    ->badge()
                    ->color('primary'),

                Tables\Columns\IconColumn::make('button_link')
                    ->label('PDF Form')
                    ->state(
                        fn (Admission $record): bool =>
                            filled($record->button_link)
                    )
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Edit'),

                Tables\Actions\DeleteAction::make()
                    ->label('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmissions::route('/'),
            'create' => Pages\CreateAdmission::route('/create'),
            'edit' => Pages\EditAdmission::route('/{record}/edit'),
        ];
    }
}
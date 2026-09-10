<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccreditationResource\Pages;
use App\Models\Accreditation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AccreditationResource extends Resource
{
    protected static ?string $model = Accreditation::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $navigationLabel = 'Accreditations';

    /*
     * កុំដាក់ Navigation Icon ព្រោះ Navigation Group
     * "Academic & Info" មាន Icon រួចហើយ។
     */
    // protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?int $navigationSort = 1;

    /*
    |--------------------------------------------------------------------------
    | Admin Form
    |--------------------------------------------------------------------------
    */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                /*
                |--------------------------------------------------------------------------
                | Accreditation Information
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Accreditation Information')
                    ->description(
                        'Enter the organization name, website, display order, and description.'
                    )
                    ->icon('heroicon-o-shield-check')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Organization Name')
                            ->placeholder(
                                'Enter the accreditation organization'
                            )
                            ->prefixIcon('heroicon-o-building-library')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('sort_order')
                            ->label('Display Order')
                            ->helperText(
                                'A lower number will appear before a higher number.'
                            )
                            ->prefixIcon('heroicon-o-arrows-up-down')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('website_link')
                            ->label('Organization Website')
                            ->placeholder('https://example.org')
                            ->helperText(
                                'Optional: enter the official website of the organization.'
                            )
                            ->prefixIcon('heroicon-o-link')
                            ->url()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->placeholder(
                                'Add a short description about this accreditation.'
                            )
                            ->helperText(
                                'This field is optional. Keep the description short and clear.'
                            )
                            ->rows(5)
                            ->maxLength(1000)
                            ->columnSpanFull(),
                    ])
                    ->columns([
                        'default' => 1,
                        'md' => 2,
                    ]),

                /*
                |--------------------------------------------------------------------------
                | Organization Logo
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Organization Logo')
                    ->description(
                        'Upload the organization logo displayed on the website.'
                    )
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        Forms\Components\FileUpload::make('logo')
                            ->label('Organization Logo')
                            ->disk('cloudinary') // 📍 បន្ថែមការភ្ជាប់ទៅ Cloudinary
                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យលោតបាត់ពេល Edit
                            ->helperText(
                                'Recommended: transparent PNG or WebP image, up to 2MB.'
                            )
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->directory('accreditations/logos')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '1:1',
                                '4:1',
                            ])
                            ->imagePreviewHeight('180')
                            ->panelAspectRatio('4:1')
                            ->panelLayout('integrated')
                            ->openable()
                            ->downloadable()
                            ->maxSize(2048)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Certificate Images
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Certificates or Documents')
                    ->description(
                        'Upload one or more accreditation certificates or supporting document images.'
                    )
                    ->icon('heroicon-o-document-check')
                    ->schema([
                        Forms\Components\FileUpload::make('document_image')
                            ->label('Certificate Images')
                            ->disk('cloudinary') // 📍 បន្ថែមការភ្ជាប់ទៅ Cloudinary
                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យលោតបាត់ពេល Edit
                            ->helperText(
                                'Upload up to 10 JPG, PNG, or WebP images. Each image must be no larger than 5MB.'
                            )
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->directory('accreditations/documents')
                            ->panelLayout('grid')
                            ->imagePreviewHeight('180')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->maxFiles(10)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),

                /*
                |--------------------------------------------------------------------------
                | Activity Gallery
                |--------------------------------------------------------------------------
                */
                Forms\Components\Section::make('Activity Gallery')
                    ->description(
                        'Upload and reorder the photos displayed in the accreditation gallery slider.'
                    )
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('gallery')
                            ->label('Gallery Images')
                            ->disk('cloudinary') // 📍 បន្ថែមការភ្ជាប់ទៅ Cloudinary
                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យលោតបាត់ពេល Edit
                            ->helperText(
                                'Upload up to 50 JPG, PNG, or WebP images. Each image must be no larger than 5MB.'
                            )
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->directory('accreditations/galleries')
                            ->panelLayout('grid')
                            ->imagePreviewHeight('160')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->maxFiles(50)
                            ->columnSpanFull(),
                    ])
                    ->collapsible(),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Admin Table
    |--------------------------------------------------------------------------
    */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                    ->label('Logo')
                    ->disk('cloudinary') // 📍 បន្ថែមសម្រាប់បង្ហាញរូបក្នុងតារាង
                    ->height(60)
                    ->width(70)
                    ->extraImgAttributes([
                        'class' => 'object-contain rounded-lg',
                    ]),

                Tables\Columns\TextColumn::make('name')
                    ->label('Organization')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->wrap(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(60)
                    ->wrap()
                    ->placeholder('No description')
                    ->tooltip(
                        function (
                            Tables\Columns\TextColumn $column
                        ): ?string {
                            $state = (string) $column->getState();

                            return mb_strlen($state) > 60
                                ? $state
                                : null;
                        }
                    ),

                /*
                 * បង្ហាញចំនួន Certificate
                 * ជំនួសការបង្ហាញរូបទាំងអស់ក្នុង Table។
                 */
                Tables\Columns\TextColumn::make('certificate_count')
                    ->label('Certificates')
                    ->state(
                        fn (Accreditation $record): int =>
                            count($record->document_image ?? [])
                    )
                    ->formatStateUsing(
                        fn ($state): string =>
                            $state . ((int) $state === 1
                                ? ' image'
                                : ' images')
                    )
                    ->badge()
                    ->color('success'),

                /*
                 * បង្ហាញចំនួនរូបក្នុង Gallery។
                 */
                Tables\Columns\TextColumn::make('gallery_count')
                    ->label('Gallery')
                    ->state(
                        fn (Accreditation $record): int =>
                            count($record->gallery ?? [])
                    )
                    ->formatStateUsing(
                        fn ($state): string =>
                            $state . ((int) $state === 1
                                ? ' photo'
                                : ' photos')
                    )
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('sort_order')
                    ->label('Order')
                    ->badge()
                    ->color('gray')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable(),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([
                //
            ])
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
            ])
            ->emptyStateHeading('No accreditations found')
            ->emptyStateDescription(
                'Create an accreditation to display it on the website.'
            )
            ->emptyStateIcon('heroicon-o-shield-check');
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public static function getRelations(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | Resource Pages
    |--------------------------------------------------------------------------
    */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAccreditations::route('/'),
            'create' => Pages\CreateAccreditation::route('/create'),
            'edit' => Pages\EditAccreditation::route('/{record}/edit'),
        ];
    }
}
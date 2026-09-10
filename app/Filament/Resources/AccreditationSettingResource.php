<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccreditationSettingResource\Pages;
use App\Models\AccreditationSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AccreditationSettingResource extends Resource
{
    protected static ?string $model = AccreditationSetting::class;

    protected static ?string $navigationGroup = 'Academic & Info';

    protected static ?string $navigationLabel = 'Accreditation Settings';

    /*
     * មិនដាក់ Navigation Icon ព្រោះ Navigation Group
     * "Academic & Info" មាន Icon រួចហើយ។
     */
    // protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?int $navigationSort = 2;

    /*
     * អនុញ្ញាតឱ្យបង្កើត Setting តែមួយប៉ុណ្ណោះ។
     */
    public static function canCreate(): bool
    {
        return ! AccreditationSetting::query()->exists();
    }

    /*
    |--------------------------------------------------------------------------
    | Form
    |--------------------------------------------------------------------------
    */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Accreditation Page Banner')
                    ->description(
                        'Upload the banner image displayed at the top of the Accreditations page.'
                    )
                    ->icon('heroicon-o-photo')
                    ->schema([
                        Forms\Components\FileUpload::make('banner_image')
                            ->label('Banner Image')
                            ->disk('cloudinary') // 📍 បន្ថែមការភ្ជាប់ទៅ Cloudinary
                            ->fetchFileInformation(false) // 📍 ការពារកុំឱ្យលោតបាត់ពេល Edit
                            ->helperText(
                                'Recommended size: 1920 × 700px. Use JPG, PNG, or WebP, up to 5MB.'
                            )
                            ->image()
                            ->acceptedFileTypes([
                                'image/jpeg',
                                'image/png',
                                'image/webp',
                            ])
                            ->directory('accreditations/banners')
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                null,
                                '16:9',
                                '21:9',
                            ])
                            ->imagePreviewHeight('320')
                            ->panelAspectRatio('21:9')
                            ->panelLayout('integrated')
                            ->openable()
                            ->downloadable()
                            ->maxSize(5120)
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Table
    |--------------------------------------------------------------------------
    */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('banner_image')
                    ->label('Banner Image')
                    ->disk('cloudinary') // 📍 បន្ថែមសម្រាប់បង្ហាញរូបក្នុងតារាង
                    ->height(90)
                    ->width(180)
                    ->extraImgAttributes([
                        'class' => 'object-cover rounded-lg',
                    ]),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d-M-Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
            ->actions([
                /*
                 * មិនដាក់ ViewAction ព្រោះ Resource នេះ
                 * មិនមាន ViewAccreditationSetting page។
                 */
                Tables\Actions\EditAction::make()
                    ->label('Edit')
                    ->color('primary'),

                Tables\Actions\DeleteAction::make()
                    ->label('Delete')
                    ->color('danger')
                    ->requiresConfirmation(),
            ])
            ->bulkActions([])
            ->emptyStateHeading('No accreditation banner found')
            ->emptyStateDescription(
                'Create a setting to upload the Accreditations page banner.'
            )
            ->emptyStateIcon('heroicon-o-photo');
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
            'index' => Pages\ListAccreditationSettings::route('/'),
            'create' => Pages\CreateAccreditationSetting::route('/create'),
            'edit' => Pages\EditAccreditationSetting::route('/{record}/edit'),
        ];
    }
}
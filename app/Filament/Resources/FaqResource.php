<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// 📍 Import មុខងារ Components ថ្មីៗសម្រាប់លម្អ
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\TextColumn;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    protected static ?string $navigationGroup = 'Website Content';

    // 📍 កំណត់ឈ្មោះនៅលើ Menu ជាភាសាអង់គ្លេសស្អាត
    protected static ?string $modelLabel = 'FAQ';
    protected static ?string $pluralModelLabel = 'FAQs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 📍 បង្កើតជាប្រអប់កាតធំមួយនៅកណ្តាលយ៉ាងស្អាត
                Section::make('Q&A Details')
                    ->description('Create or update the frequently asked question and its answer')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        TextInput::make('question')
                            ->label('❓ Question')
                            ->prefixIcon('heroicon-o-question-mark-circle')
                            ->placeholder('e.g., How do I apply for admission?')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(), // លាតពេញប្រអប់

                        // 📍 ប្រើ RichEditor ជំនួស Textarea ធម្មតា ដើម្បីអាចលេងអក្សរដិត ពណ៌ និងបញ្ជីបាន
                        RichEditor::make('answer')
                            ->label('💡 Answer')
                            ->placeholder('Provide a clear and detailed answer here...')
                            ->required()
                            ->toolbarButtons([
                                'bold', 'italic', 'underline', 'strike',
                                'bulletList', 'orderedList', 'link', 'redo', 'undo',
                            ])
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('question')
                    ->label('❓ Question')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary')
                    ->wrap(), // 📍 ឱ្យវាចុះបន្ទាត់ស្វ័យប្រវត្តិ កុំឱ្យដាច់អក្សរ (ងាយស្រួលអានសំណួរ)

                TextColumn::make('answer')
                    ->label('💡 Answer')
                    ->searchable()
                    ->limit(60) // កាត់ត្រឹម ៦០ តួអក្សរ
                    ->html(), // 📍 អនុញ្ញាតឱ្យវាបង្ហាញទម្រង់អក្សរចេញពី RichEditor យ៉ាងរលូន

                TextColumn::make('updated_at')
                    ->label('⏱️ Last Updated')
                    ->dateTime('d M Y, h:i A')
                    ->sortable()
                    ->badge()
                    ->color('success'), // ចេញជាប្រអប់ពណ៌បៃតង
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->button(),
                Tables\Actions\DeleteAction::make()->button(), // ថែមប៊ូតុងលុប
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
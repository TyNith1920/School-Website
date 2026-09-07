<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
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
use Filament\Tables\Columns\TextColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationGroup = 'Communications';

    protected static ?string $modelLabel = 'Contact Message';
    protected static ?string $pluralModelLabel = 'Contact Messages';

    // 📍 បិទមុខងារមិនឱ្យ Admin អាចចុច Create សារថ្មីបានទេ ព្រោះសារត្រូវផ្ញើពីខាងក្រៅ
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([
                        
                        // ==============================================
                        // ផ្នែកខាងឆ្វេង (Message Content)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Message Content')
                                    ->description('The inquiry or feedback sent by the user.')
                                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                                    ->schema([
                                        Textarea::make('message')
                                            ->label('💬 Message')
                                            ->rows(8)
                                            ->disabled() // ការពារមិនឱ្យ Admin កែប្រែសារដើម
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ==============================================
                        // ផ្នែកខាងស្តាំ (Sender Details)
                        // ==============================================
                        Group::make()
                            ->schema([
                                Section::make('Sender Details')
                                    ->description('Information about the person who contacted you.')
                                    ->icon('heroicon-o-user-circle')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('👤 Full Name')
                                            ->prefixIcon('heroicon-o-user')
                                            ->disabled(),
                                            
                                        TextInput::make('phone')
                                            ->label('📞 Phone Number')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->disabled(),
                                            
                                        TextInput::make('email')
                                            ->label('📧 Email Address')
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->disabled(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 1]),
                            
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('👤 Name')
                    ->searchable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('phone')
                    ->label('📞 Phone')
                    ->searchable()
                    ->copyable() // 📍 អាចចុច Copy យកទៅតេបានយ៉ាងលឿន
                    ->copyMessage('Phone number copied')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-phone'),

                TextColumn::make('email')
                    ->label('📧 Email')
                    ->searchable()
                    ->copyable() // 📍 អាចចុច Copy យកទៅផ្ញើ Mail បានយ៉ាងលឿន
                    ->copyMessage('Email copied')
                    ->copyMessageDuration(1500)
                    ->icon('heroicon-m-envelope'),

                TextColumn::make('created_at')
                    ->label('⏱️ Received At')
                    ->dateTime('d M Y, h:i A')
                    ->timezone('Asia/Phnom_Penh') // រក្សាម៉ោងនៅស្រុកខ្មែរដដែល
                    ->sortable()
                    ->badge()
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // 📍 ប្រើ EditAction ដដែល តែប្ដូររូបរាងវាឱ្យដូចប៊ូតុង View (ព្រោះចូលទៅក៏កែអត់បានដែរ)
                Tables\Actions\EditAction::make()
                    ->label('View')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->button(),
                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        // 📍 ត្រឡប់មកប្រើទម្រង់ដើមវិញ ដើម្បីកុំឱ្យលោត Error Class not found
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
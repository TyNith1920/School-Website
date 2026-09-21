<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationGroup = 'Communications';

    protected static ?string $navigationLabel = 'Inquiries & Messages';
    protected static ?string $modelLabel = 'Contact Message';
    protected static ?string $pluralModelLabel = 'Contact Messages';
    protected static ?int $navigationSort = 1;

    // 📍 បិទមិនឱ្យ Admin បង្កើតសារថ្មីដោយដៃ
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
                        // ផ្នែកខាងឆ្វេង: ខ្លឹមសារសារ
                        Group::make()
                            ->schema([
                                Section::make('Message Details')
                                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                                    ->schema([
                                        Textarea::make('message')
                                            ->label('Inquiry Message')
                                            ->rows(10)
                                            ->disabled()
                                            ->columnSpanFull(),
                                    ]),
                            ])->columnSpan(['sm' => 3, 'md' => 2]),

                        // ផ្នែកខាងស្តាំ: ព័ត៌មានអ្នកផ្ញើ
                        Group::make()
                            ->schema([
                                Section::make('Sender Information')
                                    ->icon('heroicon-o-user-circle')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Sender Name')
                                            ->prefixIcon('heroicon-o-user')
                                            ->disabled(),
                                            
                                        TextInput::make('phone')
                                            ->label('Phone Number')
                                            ->prefixIcon('heroicon-o-phone')
                                            ->disabled(),
                                            
                                        TextInput::make('email')
                                            ->label('Email Address')
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->disabled(),

                                        Placeholder::make('created_at')
                                            ->label('Received On')
                                            ->content(fn (?Contact $record): string => $record?->created_at?->timezone('Asia/Phnom_Penh')->format('d M Y, h:i A') ?? '-'),
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
                    ->label('Sender')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->color('primary'),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->icon('heroicon-m-phone')
                    ->url(fn (?string $state): ?string => filled($state) ? "tel:{$state}" : null)
                    ->copyable()
                    ->copyMessage('Phone number copied')
                    ->color('gray'),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->icon('heroicon-m-envelope')
                    ->url(fn (?string $state): ?string => filled($state) ? "mailto:{$state}" : null)
                    ->copyable()
                    ->copyMessage('Email copied')
                    ->color('info'),

                TextColumn::make('message')
                    ->label('Message Snippet')
                    ->limit(45)
                    ->color('slate')
                    ->toggleable(),

                TextColumn::make('created_at')
                    ->label('Received Date')
                    ->dateTime('d M Y, h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->sortable()
                    ->badge()
                    ->color('success'),
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                // 📍 បើកមើលសារពេញតាមរយៈ Slide-Over លើទំព័រតែមួយយ៉ាងរហ័ស
                Tables\Actions\ViewAction::make()
                    ->label('Read')
                    ->icon('heroicon-m-envelope-open')
                    ->color('primary')
                    ->slideOver()
                    ->button(),

                // 📍 ប៊ូតុង Reply ផ្ទាល់តាម Email
                Tables\Actions\Action::make('reply_email')
                    ->label('Reply')
                    ->icon('heroicon-m-arrow-uturn-left')
                    ->color('info')
                    ->url(fn (Contact $record): ?string => filled($record->email) ? "mailto:{$record->email}?subject=RE: Life International School Inquiry" : null)
                    ->openUrlInNewTab()
                    ->visible(fn (Contact $record): bool => filled($record->email))
                    ->button(),

                Tables\Actions\DeleteAction::make()->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No messages yet')
            ->emptyStateDescription('Customer and parent inquiries will appear here.')
            ->emptyStateIcon('heroicon-o-inbox');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
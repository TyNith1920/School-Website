<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Contact;
use Filament\Forms; 

class LatestContacts extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Contact::query()->latest()->limit(5)
            )
            ->heading('💬 Latest Messages Received')
            ->description('List of the most recent inquiries from website visitors.')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('👤 Name')
                    ->searchable()
                    ->weight('bold')
                    ->color('primary'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('📞 Phone Number')
                    ->icon('heroicon-m-phone')
                    ->copyable()
                    ->copyMessage('Phone copied'),
                    
                Tables\Columns\TextColumn::make('message')
                    ->label('✉️ Message')
                    ->limit(50) 
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state; 
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('⏱️ Received At')
                    ->dateTime('M d, Y h:i A')
                    ->timezone('Asia/Phnom_Penh')
                    ->badge()
                    ->color('success'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('View')
                    ->icon('heroicon-m-eye')
                    ->color('info')
                    ->button()
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('👤 Sender Name')
                            ->disabled(),
                            
                        Forms\Components\TextInput::make('phone')
                            ->label('📞 Phone Number')
                            ->disabled(),
                            
                        Forms\Components\Textarea::make('message')
                            ->label('💬 Full Message')
                            ->rows(5) 
                            ->disabled()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
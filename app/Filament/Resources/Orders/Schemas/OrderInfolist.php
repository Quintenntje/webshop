<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer.name')
                    ->label('Customer')
                    ->formatStateUsing(function ($record) {
                        if ($record->customer) {
                            return $record->customer->first_name . ' ' . $record->customer->last_name . ' (' . $record->customer->email . ')';
                        }
                        return 'Guest Order';
                    }),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('total_price')
                    ->money('EUR'),
                TextEntry::make('payment_method')
                    ->label('Payment Method')
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('_', ' ', $state ?? 'N/A'))),
                TextEntry::make('country'),
                TextEntry::make('city'),
                TextEntry::make('street')
                    ->label('Street Address'),
                TextEntry::make('postal_code')
                    ->label('Postal Code'),
                TextEntry::make('created_at')
                    ->label('Order Date')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

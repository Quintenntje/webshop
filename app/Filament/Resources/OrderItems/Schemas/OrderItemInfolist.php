<?php

namespace App\Filament\Resources\OrderItems\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderItemInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('order.id')
                    ->label('Order')
                    ->formatStateUsing(function ($record) {
                        return 'Order #' . $record->order->id . ' - €' . number_format($record->order->total_price, 2);
                    }),
                TextEntry::make('productVariant.product.name')
                    ->label('Product')
                    ->formatStateUsing(function ($record) {
                        $variant = $record->productVariant;
                        if ($variant && $variant->product) {
                            $color = $variant->color ? $variant->color->name : 'N/A';
                            $size = $variant->size ? $variant->size->name : 'N/A';
                            return $variant->product->name . ' - ' . $color . ' / ' . $size;
                        }
                        return 'N/A';
                    }),
                TextEntry::make('quantity')
                    ->numeric(),
                TextEntry::make('price')
                    ->money('EUR'),
                TextEntry::make('total')
                    ->label('Total')
                    ->formatStateUsing(function ($record) {
                        return '€' . number_format($record->price * $record->quantity, 2);
                    }),
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

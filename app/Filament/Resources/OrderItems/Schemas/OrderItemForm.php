<?php

namespace App\Filament\Resources\OrderItems\Schemas;

use App\Models\Order;
use App\Models\ProductVariant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('order_id')
                    ->label('Order')
                    ->options(
                        Order::all()->mapWithKeys(function ($order) {
                            return [$order->id => 'Order #' . $order->id . ' - €' . number_format($order->total_price, 2)];
                        })
                    )
                    ->searchable()
                    ->required(),
                Select::make('product_variant_id')
                    ->label('Product Variant')
                    ->options(
                        ProductVariant::with(['product', 'color', 'size'])->get()->mapWithKeys(function ($variant) {
                            return [$variant->id => $variant->product->name . ' - ' . $variant->color->name . ' / ' . $variant->size->name];
                        })
                    )
                    ->searchable()
                    ->required(),
                TextInput::make('quantity')
                    ->required()
                    ->numeric(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('€'),
            ]);
    }
}

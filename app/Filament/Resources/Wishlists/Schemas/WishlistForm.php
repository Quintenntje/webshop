<?php

namespace App\Filament\Resources\Wishlists\Schemas;

use App\Models\Customer;
use App\Models\ProductVariant;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class WishlistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('customer_id')
                    ->label('Customer')
                    ->options(
                        Customer::all()->mapWithKeys(function ($customer) {
                            return [$customer->id => $customer->first_name . ' ' . $customer->last_name . ' (' . $customer->email . ')'];
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
            ]);
    }
}

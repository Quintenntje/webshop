<?php

namespace App\Filament\Resources\Wishlists\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class WishlistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
                TextInput::make('product_variant_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}

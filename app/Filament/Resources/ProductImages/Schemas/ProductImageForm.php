<?php

namespace App\Filament\Resources\ProductImages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('filename')
                    ->required(),
                TextInput::make('product_id')
                    ->required()
                    ->numeric(),
                TextInput::make('color_id')
                    ->required()
                    ->numeric(),
                Toggle::make('is_primary')
                    ->required(),
            ]);
    }
}

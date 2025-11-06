<?php

namespace App\Filament\Resources\ProductVariants\Schemas;

use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductVariantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Product')
                    ->options(Product::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('color_id')
                    ->label('Color')
                    ->options(ProductColor::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                Select::make('size_id')
                    ->label('Size')
                    ->options(ProductSize::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
            ]);
    }
}

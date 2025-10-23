<?php

namespace App\Filament\Resources\ProductSizes;

use App\Filament\Resources\ProductSizes\Pages\CreateProductSize;
use App\Filament\Resources\ProductSizes\Pages\EditProductSize;
use App\Filament\Resources\ProductSizes\Pages\ListProductSizes;
use App\Filament\Resources\ProductSizes\Schemas\ProductSizeForm;
use App\Filament\Resources\ProductSizes\Tables\ProductSizesTable;
use App\Models\ProductSize;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductSizeResource extends Resource
{
    protected static ?string $model = ProductSize::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'sizes';

    public static function form(Schema $schema): Schema
    {
        return ProductSizeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductSizesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProductSizes::route('/'),
            'create' => CreateProductSize::route('/create'),
            'edit' => EditProductSize::route('/{record}/edit'),
        ];
    }
}

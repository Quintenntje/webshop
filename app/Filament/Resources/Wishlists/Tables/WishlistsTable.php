<?php

namespace App\Filament\Resources\Wishlists\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WishlistsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                    ->label('Customer')
                    ->formatStateUsing(function ($record) {
                        if ($record->customer) {
                            return $record->customer->first_name . ' ' . $record->customer->last_name . ' (' . $record->customer->email . ')';
                        }
                        return 'N/A';
                    })
                    ->searchable(['customer.first_name', 'customer.last_name', 'customer.email'])
                    ->sortable(),
                TextColumn::make('productVariant.product.name')
                    ->label('Product')
                    ->formatStateUsing(function ($record) {
                        $variant = $record->productVariant;
                        if ($variant && $variant->product) {
                            $color = $variant->color ? $variant->color->name : 'N/A';
                            $size = $variant->size ? $variant->size->name : 'N/A';
                            return $variant->product->name . ' - ' . $color . ' / ' . $size;
                        }
                        return 'N/A';
                    })
                    ->searchable(['productVariant.product.name'])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

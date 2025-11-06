<?php

namespace App\Filament\Resources\OrderItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order.id')
                    ->label('Order')
                    ->formatStateUsing(function ($record) {
                        return 'Order #' . $record->order->id;
                    })
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
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('price')
                    ->money('EUR')
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
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

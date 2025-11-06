<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Models\Customer;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
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
                Select::make('status')
                    ->options(['pending' => 'Pending', 'paid' => 'Paid', 'expired' => 'Expired', 'canceled' => 'Cancelled'])
                    ->required(),
                TextInput::make('total_price')
                    ->required()
                    ->numeric(),
                TextInput::make('country')
                    ->required(),
                TextInput::make('city')
                    ->required(),
                TextInput::make('street')
                    ->required(),
                TextInput::make('postal_code')
                    ->required(),
            ]);
    }
}

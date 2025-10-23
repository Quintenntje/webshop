<?php

namespace App\Filament\Resources\DiscountCodes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DiscountCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->required(),
                Select::make('type')
                    ->options(['percentage' => 'Percentage', 'fixed' => 'Fixed'])
                    ->default('percentage')
                    ->required(),
                TextInput::make('value')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                DatePicker::make('expires_at'),
                Toggle::make('active')
                    ->required(),
            ]);
    }
}

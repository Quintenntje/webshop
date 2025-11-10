<?php

namespace App\Filament\Resources\NewsLetters\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsLetterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
            ]);
    }
}

<?php

namespace App\Filament\Resources\NewsLetters;

use App\Filament\Resources\NewsLetters\Pages\CreateNewsLetter;
use App\Filament\Resources\NewsLetters\Pages\EditNewsLetter;
use App\Filament\Resources\NewsLetters\Pages\ListNewsLetters;
use App\Filament\Resources\NewsLetters\Schemas\NewsLetterForm;
use App\Filament\Resources\NewsLetters\Tables\NewsLettersTable;
use App\Models\NewsLetter;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NewsLetterResource extends Resource
{
    protected static ?string $model = NewsLetter::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'News letter';

    public static function form(Schema $schema): Schema
    {
        return NewsLetterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewsLettersTable::configure($table);
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
            'index' => ListNewsLetters::route('/'),
            'create' => CreateNewsLetter::route('/create'),
            'edit' => EditNewsLetter::route('/{record}/edit'),
        ];
    }
}

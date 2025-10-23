<?php

namespace App\Filament\Resources\Genders;

use App\Filament\Resources\Genders\Pages\CreateGender;
use App\Filament\Resources\Genders\Pages\EditGender;
use App\Filament\Resources\Genders\Pages\ListGenders;
use App\Filament\Resources\Genders\Schemas\GenderForm;
use App\Filament\Resources\Genders\Tables\GendersTable;
use App\Models\Gender;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class GenderResource extends Resource
{
    protected static ?string $model = Gender::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Genders';

    public static function form(Schema $schema): Schema
    {
        return GenderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return GendersTable::configure($table);
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
            'index' => ListGenders::route('/'),
            'create' => CreateGender::route('/create'),
            'edit' => EditGender::route('/{record}/edit'),
        ];
    }
}

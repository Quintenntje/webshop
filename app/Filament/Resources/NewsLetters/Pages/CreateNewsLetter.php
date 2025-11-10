<?php

namespace App\Filament\Resources\NewsLetters\Pages;

use App\Filament\Resources\NewsLetters\NewsLetterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsLetter extends CreateRecord
{
    protected static string $resource = NewsLetterResource::class;
}

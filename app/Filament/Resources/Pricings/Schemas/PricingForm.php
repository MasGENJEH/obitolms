<?php

namespace App\Filament\Resources\Pricings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class PricingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('details')
                ->columnSpanFull() // agar grid column mengisi full
                ->schema([
                    TextInput::make('name')
                    ->maxlength(255)
                    ->required(),

                    TextInput::make('price')
                    ->numeric()
                    ->prefix('IDR'),

                    TextInput::make('duration')
                    ->numeric(255)
                    ->prefix('Month'),
                ]),
            ]);
    }
}

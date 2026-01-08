<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->maxLength(255)
                    ->required(),

                Select::make('occupation')
                    ->options([
                        'Developer' => 'Developer',
                        'Designer' => 'Designer',
                        'Project Manager' => 'Project Manager',
                    ])
                    ->required(),

                TextInput::make('email')
                    ->maxLength(255)
                    ->email()
                    ->required(),

                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(9)
                    ->maxLength(255),

                Select::make('roles')
                    ->label('role')
                    ->relationship('roles', 'name')
                    ->required(),

                FileUpload::make('photo')
                    ->required()
                    ->image(),
            ]);
    }
}

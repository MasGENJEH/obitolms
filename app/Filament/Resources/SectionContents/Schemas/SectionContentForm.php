<?php

namespace App\Filament\Resources\SectionContents\Schemas;

use App\Models\CourseSection;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SectionContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_section_id')
                ->label('Course Section')
                ->options(function () {
                    return CourseSection::with('course')
                    ->get()
                    ->mapWithKeys(function ($section) {
                        return [
                            $section->id => $section->course
                                ? "{$section->course->name} - {$section->name}"
                                : $section->name,
                        ];
                    })->toArray();
                })
                ->searchable()
                ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                RichEditor::make('content')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}

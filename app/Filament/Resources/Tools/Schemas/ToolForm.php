<?php

namespace App\Filament\Resources\Tools\Schemas;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ToolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),

                TextInput::make('code')
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('name')
                    ->required(),

                Textarea::make('description')
                    ->nullable(),

                TextInput::make('stock')
                    ->numeric()
                    ->minValue(0)
                    ->required(),

                Select::make('condition')
                    ->options([
                        'good' => 'Baik',
                        'maintenance' => 'Dalam Perawatan',
                        'damaged' => 'Rusak',
                    ])
                    ->required(),

                Toggle::make('is_active')
                    ->default(true),
            ]);
    }
}

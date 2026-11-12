<?php

namespace App\Filament\Resources\BorrowingDetails\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BorrowingDetailsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('borrowing_id')
                    ->label('Transaksi Peminjaman')
                    ->relationship('borrowing', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('tool_id')
                    ->label('Alat')
                    ->relationship('tool', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('quantity')
                    ->label('Jumlah Dipinjam')
                    ->numeric()
                    ->minValue(1)
                    ->required(),
            ]);
    }
}

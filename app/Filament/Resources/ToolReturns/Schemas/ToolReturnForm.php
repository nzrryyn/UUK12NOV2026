<?php

namespace App\Filament\Resources\ToolReturns\Schemas;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ToolReturnForm
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

                DateTimePicker::make('returned_at')
                    ->label('Waktu Pengembalian')
                    ->required(),

                Select::make('received_by')
                    ->label('Diterima Oleh')
                    ->relationship('receiver', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
            ]);
    }
}

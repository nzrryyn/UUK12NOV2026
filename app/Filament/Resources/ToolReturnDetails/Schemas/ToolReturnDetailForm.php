<?php

namespace App\Filament\Resources\ToolReturnDetails\Schemas;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ToolReturnDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tool_return_id')
                    ->label('Transaksi Pengembalian')
                    ->relationship('toolReturn', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('borrowing_detail_id')
                    ->label('Detail Peminjaman')
                    ->relationship('borrowingDetail', 'id')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('quantity_returned')
                    ->label('Jumlah Dikembalikan')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                Select::make('condition')
                    ->label('Kondisi Alat')
                    ->options([
                        'good' => 'Baik',
                        'damaged' => 'Rusak',
                        'maintenance' => 'Dalam Perawatan',
                    ])
                    ->required(),

                TextInput::make('fine_amount')
                    ->label('Jumlah Denda')
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->minValue(0)
                    ->required(),
            ]);
    }
}

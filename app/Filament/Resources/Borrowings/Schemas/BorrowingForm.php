<?php
namespace App\Filament\Resources\Borrowings\Schemas;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;


use Filament\Schemas\Schema;

class BorrowingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Peminjam')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('approved_by')
                    ->label('Disetujui Oleh')
                    ->relationship('approver', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                 DatePicker::make('borrow_date')
                    ->label('Tanggal Peminjaman')
                    ->required(),

                DatePicker::make('due_date')
                    ->label('Tanggal Pengembalian')
                    ->required()
                    ->afterOrEqual('borrow_date'),

                Select::make('status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        'completed' => 'Selesai',
                        ])
                    ->default('pending')
                    ->required(),

                Textarea::make('notes')
                    ->label('Catatan')
                    ->columnSpanFull(),
                    ]);
    }
}

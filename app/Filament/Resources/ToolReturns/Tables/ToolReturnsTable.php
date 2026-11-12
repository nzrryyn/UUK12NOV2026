<?php

namespace App\Filament\Resources\ToolReturns\Tables;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ToolReturnsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('borrowing.id')
                    ->label('ID Peminjaman')
                    ->sortable(),

                TextColumn::make('returned_at')
                    ->label('Waktu Pengembalian')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),

                TextColumn::make('receiver.name')
                    ->label('Diterima Oleh'),

                TextColumn::make('notes')
                    ->label('Catatan')
                    ->limit(50),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                DeleteAction::make(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

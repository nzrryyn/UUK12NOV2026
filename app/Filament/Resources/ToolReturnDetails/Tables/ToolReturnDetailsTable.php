<?php

namespace App\Filament\Resources\ToolReturnDetails\Tables;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ToolReturnDetailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('toolReturn.id')
                    ->label('ID Pengembalian'),

                TextColumn::make('borrowingDetail.tool.name')
                    ->label('Nama Alat'),

                TextColumn::make('quantity_returned')
                    ->label('Jumlah Dikembalikan')
                    ->numeric(),

                TextColumn::make('condition')
                    ->label('Kondisi')
                    ->badge(),

                TextColumn::make('fine_amount')
                    ->label('Denda')
                    ->money('IDR', locale: 'id'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

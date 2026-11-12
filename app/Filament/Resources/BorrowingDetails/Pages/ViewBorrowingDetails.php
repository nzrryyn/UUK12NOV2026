<?php

namespace App\Filament\Resources\BorrowingDetails\Pages;

use App\Filament\Resources\BorrowingDetails\BorrowingDetailsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBorrowingDetails extends ViewRecord
{
    protected static string $resource = BorrowingDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

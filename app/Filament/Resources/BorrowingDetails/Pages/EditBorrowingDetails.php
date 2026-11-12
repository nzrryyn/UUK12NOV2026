<?php

namespace App\Filament\Resources\BorrowingDetails\Pages;

use App\Filament\Resources\BorrowingDetails\BorrowingDetailsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditBorrowingDetails extends EditRecord
{
    protected static string $resource = BorrowingDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

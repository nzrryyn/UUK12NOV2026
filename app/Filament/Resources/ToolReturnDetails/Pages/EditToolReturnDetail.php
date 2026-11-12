<?php

namespace App\Filament\Resources\ToolReturnDetails\Pages;

use App\Filament\Resources\ToolReturnDetails\ToolReturnDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditToolReturnDetail extends EditRecord
{
    protected static string $resource = ToolReturnDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

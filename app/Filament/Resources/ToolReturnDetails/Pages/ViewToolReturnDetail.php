<?php

namespace App\Filament\Resources\ToolReturnDetails\Pages;

use App\Filament\Resources\ToolReturnDetails\ToolReturnDetailResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewToolReturnDetail extends ViewRecord
{
    protected static string $resource = ToolReturnDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

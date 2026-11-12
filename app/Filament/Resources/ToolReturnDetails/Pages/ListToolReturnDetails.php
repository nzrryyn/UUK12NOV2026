<?php

namespace App\Filament\Resources\ToolReturnDetails\Pages;

use App\Filament\Resources\ToolReturnDetails\ToolReturnDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListToolReturnDetails extends ListRecords
{
    protected static string $resource = ToolReturnDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

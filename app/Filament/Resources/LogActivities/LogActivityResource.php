<?php

namespace App\Filament\Resources\LogActivities;

use App\Filament\Resources\LogActivities\Pages\CreateLogActivity;
use App\Filament\Resources\LogActivities\Pages\EditLogActivity;
use App\Filament\Resources\LogActivities\Pages\ListLogActivities;
use App\Filament\Resources\LogActivities\Pages\ViewLogActivity;
use App\Filament\Resources\LogActivities\Schemas\LogActivityForm;
use App\Filament\Resources\LogActivities\Schemas\LogActivityInfolist;
use App\Filament\Resources\LogActivities\Tables\LogActivitiesTable;
use App\Models\LogActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LogActivityResource extends Resource
{
    protected static ?string $model = LogActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LogActivityForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return LogActivityInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LogActivitiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLogActivities::route('/'),
            'create' => CreateLogActivity::route('/create'),
            'view' => ViewLogActivity::route('/{record}'),
            'edit' => EditLogActivity::route('/{record}/edit'),
        ];
    }
}

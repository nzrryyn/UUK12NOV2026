<?php

namespace App\Filament\Resources\ToolReturns;

use App\Filament\Resources\ToolReturns\Pages\CreateToolReturn;
use App\Filament\Resources\ToolReturns\Pages\EditToolReturn;
use App\Filament\Resources\ToolReturns\Pages\ListToolReturns;
use App\Filament\Resources\ToolReturns\Pages\ViewToolReturn;
use App\Filament\Resources\ToolReturns\Schemas\ToolReturnForm;
use App\Filament\Resources\ToolReturns\Schemas\ToolReturnInfolist;
use App\Filament\Resources\ToolReturns\Tables\ToolReturnsTable;
use App\Models\ToolReturn;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ToolReturnResource extends Resource
{   
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
    $query = parent::getEloquentQuery();

    if (auth()->user()?->role === 'peminjam') {
        $query->whereHas('borrowing', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }

    return $query;
    }
    protected static ?string $model = ToolReturn::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ToolReturnForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ToolReturnInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ToolReturnsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function canViewAny(): bool
    {
    return in_array(auth()->user()?->role, [
        'admin',
        'petugas',
        'peminjam',
    ]);
    }

    public static function canCreate(): bool
    {
    return in_array(auth()->user()?->role, [
        'admin',
        'petugas',
    ]);
    }

    public static function canEdit($record): bool
    {
    return in_array(auth()->user()?->role, [
        'admin',
        'petugas',
    ]);
    }

    public static function canDelete($record): bool
    {
    return auth()->user()?->role === 'admin';
    }

    public static function canView($record): bool
    {
    $user = auth()->user();

    return $user?->role !== 'peminjam'
        || $record->borrowing?->user_id === $user->id;
    }
    public static function getPages(): array
    {
        return [
            'index' => ListToolReturns::route('/'),
            'create' => CreateToolReturn::route('/create'),
            'view' => ViewToolReturn::route('/{record}'),
            'edit' => EditToolReturn::route('/{record}/edit'),
        ];
    }
}

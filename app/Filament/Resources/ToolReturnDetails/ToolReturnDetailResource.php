<?php

namespace App\Filament\Resources\ToolReturnDetails;

use App\Filament\Resources\ToolReturnDetails\Pages\CreateToolReturnDetail;
use App\Filament\Resources\ToolReturnDetails\Pages\EditToolReturnDetail;
use App\Filament\Resources\ToolReturnDetails\Pages\ListToolReturnDetails;
use App\Filament\Resources\ToolReturnDetails\Pages\ViewToolReturnDetail;
use App\Filament\Resources\ToolReturnDetails\Schemas\ToolReturnDetailForm;
use App\Filament\Resources\ToolReturnDetails\Schemas\ToolReturnDetailInfolist;
use App\Filament\Resources\ToolReturnDetails\Tables\ToolReturnDetailsTable;
use App\Models\ToolReturnDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ToolReturnDetailResource extends Resource
{
    protected static ?string $model = ToolReturnDetail::class;

    protected static string|BackedEnum|null $navigationIcon =
        Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    // FORM
    public static function form(Schema $schema): Schema
    {
        return ToolReturnDetailForm::configure($schema);
    }

    // INFOLIST
    public static function infolist(Schema $schema): Schema
    {
        return ToolReturnDetailInfolist::configure($schema);
    }

    // TABLE
    public static function table(Table $table): Table
    {
        return ToolReturnDetailsTable::configure($table);
    }

    // AUTHORIZATION

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

        if ($user?->role !== 'peminjam') {
            return in_array($user?->role, ['admin', 'petugas']);
        }

        return $record->toolReturn?->borrowing?->user_id === $user->id;
    }

    // FILTER DATA
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->user()?->role === 'peminjam') {
            $query->whereHas('toolReturn.borrowing', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        return $query;
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
            'index' => ListToolReturnDetails::route('/'),
            'create' => CreateToolReturnDetail::route('/create'),
            'view' => ViewToolReturnDetail::route('/{record}'),
            'edit' => EditToolReturnDetail::route('/{record}/edit'),
        ];
    }
}

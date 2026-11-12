<?php

namespace App\Filament\Resources\BorrowingDetails;

use App\Filament\Resources\BorrowingDetails\Pages\CreateBorrowingDetails;
use App\Filament\Resources\BorrowingDetails\Pages\EditBorrowingDetails;
use App\Filament\Resources\BorrowingDetails\Pages\ListBorrowingDetails;
use App\Filament\Resources\BorrowingDetails\Pages\ViewBorrowingDetails;
use App\Filament\Resources\BorrowingDetails\Schemas\BorrowingDetailsForm;
use App\Filament\Resources\BorrowingDetails\Schemas\BorrowingDetailsInfolist;
use App\Filament\Resources\BorrowingDetails\Tables\BorrowingDetailsTable;
use App\Models\BorrowingDetail;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BorrowingDetailsResource extends Resource
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
    protected static ?string $model = BorrowingDetail::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BorrowingDetailsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BorrowingDetailsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BorrowingDetailsTable::configure($table);
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
    return auth()->user()?->role === 'admin';
    }

    public static function canEdit($record): bool
    {
    return auth()->user()?->role === 'admin';
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
            'index' => ListBorrowingDetails::route('/'),
            'create' => CreateBorrowingDetails::route('/create'),
            'view' => ViewBorrowingDetails::route('/{record}'),
            'edit' => EditBorrowingDetails::route('/{record}/edit'),
        ];
    }
}

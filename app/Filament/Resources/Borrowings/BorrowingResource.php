<?php

namespace App\Filament\Resources\Borrowings;

use App\Filament\Resources\Borrowings\Pages\CreateBorrowing;
use App\Filament\Resources\Borrowings\Pages\EditBorrowing;
use App\Filament\Resources\Borrowings\Pages\ListBorrowings;
use App\Filament\Resources\Borrowings\Pages\ViewBorrowing;
use App\Filament\Resources\Borrowings\Schemas\BorrowingForm;
use App\Filament\Resources\Borrowings\Schemas\BorrowingInfolist;
use App\Filament\Resources\Borrowings\Tables\BorrowingsTable;
use App\Models\Borrowing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BorrowingResource extends Resource
{   
    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
    $query = parent::getEloquentQuery();

    if (auth()->user()?->role === 'peminjam') {
        $query->where('user_id', auth()->id());
    }

    return $query;
    }
    public static function canView($record): bool
    {
    $user = auth()->user();

    return $user?->role !== 'peminjam'
        || $record->user_id === $user->id;
    }
    protected static ?string $model = Borrowing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BorrowingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BorrowingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BorrowingsTable::configure($table);
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
        'peminjam',
    ]);
    }

    public static function canEdit($record): bool
    {
    $user = auth()->user();

    if ($user?->role === 'admin') {
        return true;
    }

    return $user?->role === 'petugas';
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBorrowings::route('/'),
            'create' => CreateBorrowing::route('/create'),
            'view' => ViewBorrowing::route('/{record}'),
            'edit' => EditBorrowing::route('/{record}/edit'),
        ];
    }
}

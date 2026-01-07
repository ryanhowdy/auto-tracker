<?php

namespace App\Filament\Resources\ServiceHistories;

use App\Filament\Resources\ServiceHistories\Pages\CreateServiceHistory;
use App\Filament\Resources\ServiceHistories\Pages\EditServiceHistory;
use App\Filament\Resources\ServiceHistories\Pages\ListServiceHistories;
use App\Filament\Resources\ServiceHistories\Schemas\ServiceHistoryForm;
use App\Filament\Resources\ServiceHistories\Tables\ServiceHistoriesTable;
use App\Models\ServiceHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceHistoryResource extends Resource
{
    protected static ?string $model = ServiceHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::WrenchScrewdriver;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $slug = 'history';

    protected static ?int $navigationSort = 1;

    protected static ?string $pluralModelLabel = 'service history';

    protected static ?string $navigationLabel = 'Service History';

    public static function form(Schema $schema): Schema
    {
        return ServiceHistoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceHistoriesTable::configure($table);
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
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
            'index' => ListServiceHistories::route('/'),
            'create' => CreateServiceHistory::route('/create'),
            'edit' => EditServiceHistory::route('/{record}/edit'),
        ];
    }
}

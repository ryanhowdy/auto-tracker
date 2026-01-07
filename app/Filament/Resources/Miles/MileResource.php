<?php

namespace App\Filament\Resources\Miles;

use App\Filament\Resources\Miles\Pages\CreateMile;
use App\Filament\Resources\Miles\Pages\EditMile;
use App\Filament\Resources\Miles\Pages\ListMiles;
use App\Filament\Resources\Miles\Schemas\MileForm;
use App\Filament\Resources\Miles\Tables\MilesTable;
use App\Models\Mile;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MileResource extends Resource
{
    protected static ?string $model = Mile::class;

    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedCog8Tooth;

    protected static string | UnitEnum | null $navigationGroup = 'Config';

    public static function form(Schema $schema): Schema
    {
        return MileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MilesTable::configure($table);
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
            'index' => ListMiles::route('/'),
            'create' => CreateMile::route('/create'),
            'edit' => EditMile::route('/{record}/edit'),
        ];
    }
}

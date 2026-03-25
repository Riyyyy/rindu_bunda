<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RinduBundaResource\Pages;
use App\Filament\Resources\RinduBundaResource\RelationManagers;
use App\Models\Coa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RinduBundaResource extends Resource
{
    protected static ?string $model = Coa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
             ->schema([
                //isikan dengan input type form
                Grid::make(1) // Membuat hanya 1 kolom
                ->schema([
                    TextInput::make('header_akun')
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),

                    TextInput::make('kode_akun')
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),

                    TextInput::make('nama_akun')
                        ->autocapitalize('words')
                        ->label('Nama akun')
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
                ->columns([
                //isikan kolom mana saja yang akan ditampilkan di sini
                TextColumn::make('header_akun'),
                TextColumn::make('kode_akun'),
                TextColumn::make('nama_akun'), 
            ])
            ->filters([
            //untuk membuat filter 
                Tables\Filters\SelectFilter::make('header_akun')
                    ->options([
                        1 => 'Aset/Aktiva',
                        2 => 'Utang',
                        3 => 'Modal',
                        4 => 'Pendapatan',
                        5 => 'Beban',
                    ]),
            ])
            ->actions([
                 // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListRinduBundas::route('/'),
            'create' => Pages\CreateRinduBunda::route('/create'),
            'edit' => Pages\EditRinduBunda::route('/{record}/edit'),
        ];
    }
}

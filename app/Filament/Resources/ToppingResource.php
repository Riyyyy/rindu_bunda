<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToppingResource\Pages;
use App\Filament\Resources\ToppingResource\RelationManagers;
use App\Models\Topping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ToppingResource extends Resource
{
    protected static ?string $model = Topping::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';
    protected static ?string $navigationGroup = 'Master Data';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)
                ->schema([
                    TextInput::make('kode_topping')
                        ->label('Kode Topping')
                        ->default(fn () => \App\Models\Topping::getKodeTopping())
                        ->required()
                        ->readonly()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),

                    TextInput::make('nama_topping')
                        ->label('Nama Topping')
                        ->placeholder('Masukkan nama topping')
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),

                    TextInput::make('harga_topping')
                        ->label('Harga Topping')
                        ->placeholder('Masukkan harga topping')
                        ->prefix('Rp')
                        ->mask('999.999.999.999')
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->extraInputAttributes([
                            'class' => 'w-full rounded-lg !border-red-600 focus:!border-red-600 focus:!ring-red-600',
                        ])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),

                    FileUpload::make('foto')
                        ->label('Foto Topping')
                        ->directory('foto-topping')
                        ->image()
                        ->required()
                        ->validationMessages(['required' => 'data wajib diisi'])
                        ->helperText(new \Illuminate\Support\HtmlString('<p class="mt-1 text-sm text-red-600 font-medium">data wajib diisi</p>')),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_topping')
                    ->label('Kode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_topping')
                    ->label('Nama Topping')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('harga_topping')
                    ->label('Harga')
                    ->formatStateUsing(fn ($state) => 'Rp ' . number_format((float)$state, 0, ',', '.'))
                    ->extraAttributes(['class' => 'text-right'])
                    ->sortable(),

                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListToppings::route('/'),
            'create' => Pages\CreateTopping::route('/create'),
            'edit' => Pages\EditTopping::route('/{record}/edit'),
        ];
    }
}
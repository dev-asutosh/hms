<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReceptionistResource\Pages;
use App\Filament\Resources\ReceptionistResource\RelationManagers;
use App\Models\Receptionist;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

class ReceptionistResource extends Resource
{
    protected static ?string $model = Receptionist::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Group::make([
                TextInput::make('user.name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('user.email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('user.password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(6)
                    ->maxLength(255)
                    ->visibleOn('create') // hide during edit
                    ->dehydrateStateUsing(fn ($state) => \Hash::make($state)),

                TextInput::make('phone')
                    ->label('Phone')
                    ->required()
                    ->maxLength(20),
            ])
        ]);
}

public static function table(Tables\Table $table): Tables\Table
{
    return $table
        ->columns([
            TextColumn::make('user.name')->label('Name')->searchable(),
            TextColumn::make('user.email')->label('Email')->searchable(),
            TextColumn::make('phone')->label('Phone')->searchable(),
            TextColumn::make('created_at')->label('Created')->dateTime('d M Y'),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListReceptionists::route('/'),
            'create' => Pages\CreateReceptionist::route('/create'),
            'edit' => Pages\EditReceptionist::route('/{record}/edit'),
        ];
    }
}

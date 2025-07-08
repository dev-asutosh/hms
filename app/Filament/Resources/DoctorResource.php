<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorResource\Pages;
use App\Filament\Resources\DoctorResource\RelationManagers;
use App\Models\Doctor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;

class DoctorResource extends Resource
{
    protected static ?string $model = Doctor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
    return $form->schema([
        TextInput::make('user.name')
            ->label('Name')
            ->required(),

        TextInput::make('user.email')
            ->label('Email')
            ->required()
            ->email(),

        TextInput::make('user.password')
            ->label('Password')
            ->password()
            ->required()
            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
            ->visibleOn('create'),

        TextInput::make('specialization')
            ->required(),

        TextInput::make('phone'),
    ]);
}

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            TextColumn::make('user.name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('user.email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('specialization')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone'),

            TextColumn::make('created_at')
                ->dateTime('d M Y, h:i A')
                ->label('Created'),
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
            'index' => Pages\ListDoctors::route('/'),
            'create' => Pages\CreateDoctor::route('/create'),
            'edit' => Pages\EditDoctor::route('/{record}/edit'),
        ];
    }
}

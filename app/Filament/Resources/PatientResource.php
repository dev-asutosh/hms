<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
// use Filament\Resources\Form as ResourceForm;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ActionGroup;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

public static function form(Form $form): Form
{
   return $form
        ->schema([
            Section::make('Patient Info')
                ->description('Basic patient details')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('first_name')->required()->label('First Name'),
                        TextInput::make('last_name')->required()->label('Last Name'),
                        DatePicker::make('dob')->label('Date of Birth'),
                        TextInput::make('phone')->label('Phone Number'),
                        Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])->label('Gender'),
                        Select::make('blood_group')
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                            ])->label('Blood Group'),
                    ]),
                    Textarea::make('address')->columnSpan(2)->label('Address'),
                ])
                ->columns(1)
                ->collapsible(),

            Section::make('Account Info')
                ->description('Login information for the patient')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('user.name')->label('Full Name')->required(),
                        TextInput::make('user.email')->email()->required()->unique(\App\Models\User::class, 'email'),
                        TextInput::make('user.password')
                            ->label('Password')
                            ->password()
                            ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                            ->confirmed(),
                        TextInput::make('user.password_confirmation')
                            ->label('Confirm Password')
                            ->password()
                            ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
                    ]),
                ])
                ->columns(1)
                ->collapsible(),
        ]);
}
    

    public static function table(Table $table): Table
    {
    return $table
        ->columns([
            TextColumn::make('full_name')
                ->label('Full Name')
                ->getStateUsing(fn ($record) => $record->first_name . ' ' . $record->last_name)
                ->sortable()
                ->searchable(),

            TextColumn::make('user.email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            TextColumn::make('phone')
                ->label('Phone')
                ->sortable()
                ->searchable(),
        ])
        ->actions([
            ActionGroup::make([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ]),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}

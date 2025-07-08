<?php

namespace App\Filament\Resources\DoctorResource\Pages;

use App\Filament\Resources\DoctorResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDoctor extends EditRecord
{
    protected static string $resource = DoctorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    /**
     * Update linked user info (name, email) when editing doctor
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update associated user
        $this->record->user->update([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
        ]);

        // Don't save nested user data in doctors table
        unset($data['user']);

        return $data;
    }
}


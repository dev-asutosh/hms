<?php

namespace App\Filament\Resources\ReceptionistResource\Pages;

use App\Filament\Resources\ReceptionistResource;
use Filament\Resources\Pages\EditRecord;

class EditReceptionist extends EditRecord
{
    protected static string $resource = ReceptionistResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update the linked user
        $this->record->user->update([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
        ]);

        // Remove nested 'user' data to prevent mass-assignment error
        unset($data['user']);

        return $data;
    }
}

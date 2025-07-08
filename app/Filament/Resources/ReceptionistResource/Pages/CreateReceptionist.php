<?php

namespace App\Filament\Resources\ReceptionistResource\Pages;

use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ReceptionistResource;
use Illuminate\Support\Facades\Hash;

class CreateReceptionist extends CreateRecord
{
    protected static string $resource = ReceptionistResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create a new user first
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => Hash::make($data['user']['password']),
        ]);

        // Assign the "receptionist" role
        $user->assignRole('receptionist');

        // Replace nested user fields with user_id
        $data['user_id'] = $user->id;
        unset($data['user']);

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

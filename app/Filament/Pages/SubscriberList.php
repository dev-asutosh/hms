<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Subscriber;

class SubscriberList extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static string $view = 'filament.admin.pages.subscribers';

    public function getViewData(): array
    {
        return [
            'subscribers' => Subscriber::all(),
        ];
    }
}


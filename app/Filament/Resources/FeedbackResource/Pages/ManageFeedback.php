<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFeedback extends ManageRecords
{
    protected static string $resource = FeedbackResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // canCreate is set to false in FeedbackResource, so this 
            // button will not be shown anyway
            Actions\CreateAction::make(),
        ];
    }
}

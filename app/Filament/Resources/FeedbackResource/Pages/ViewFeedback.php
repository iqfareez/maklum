<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Infolists;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                TextEntry::make('created_at')
                    ->label('Created At')
                    ->formatStateUsing(function ($state) {
                        return $state->format('D, d/m/Y h:i:s A');
                    }),
                TextEntry::make('public_id')
                    ->label('Feedback ID')
                    ->badge()
                    ->color('primary'),
                TextEntry::make('name')
                    ->label('Sender Name'),
                TextEntry::make('email')
                    ->label('Sender Email'),
                TextEntry::make('message')
                    ->size(TextEntrySize::Large)
                    ->columnSpanFull(),
                Section::make('Device Information')
                    ->collapsible()
                    ->schema([
                        // Sadly, we can't make use of the KeyValueEntry component: https://filamentphp.com/docs/3.x/infolists/entries/key-value
                        // due to the json have nested arrays
                        TextEntry::make('device_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) return '';

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) return $state;

                                $formattedOutput = '';
                                foreach ($decodedInfo as $key => $value) {
                                    $formattedKey = ucwords(str_replace('_', ' ', $key));
                                    $formattedValue = is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
                                    $formattedOutput .= "**{$formattedKey}:** {$formattedValue}\n\n";
                                }

                                return $formattedOutput;
                            })
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
                Section::make('App Information')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('app_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) return '';

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) return $state;

                                $formattedOutput = '';
                                foreach ($decodedInfo as $key => $value) {
                                    $formattedKey = ucwords(str_replace('_', ' ', $key));
                                    $formattedValue = is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
                                    $formattedOutput .= "**{$formattedKey}:** {$formattedValue}\n\n";
                                }

                                return $formattedOutput;
                            })
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
                Section::make('Other Information')
                    ->collapsible()
                    ->schema([
                        Infolists\Components\TextEntry::make('additional_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) return '';

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) return $state;

                                $formattedOutput = '';
                                foreach ($decodedInfo as $key => $value) {
                                    $formattedKey = ucwords(str_replace('_', ' ', $key));
                                    $formattedValue = is_array($value) ? json_encode($value, JSON_PRETTY_PRINT) : $value;
                                    $formattedOutput .= "**{$formattedKey}:** {$formattedValue}\n\n";
                                }

                                return $formattedOutput;
                            })
                            ->markdown()
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}

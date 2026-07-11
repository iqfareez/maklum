<?php

namespace App\Filament\Resources\Feedback\Pages;

use App\Filament\Resources\Feedback\FeedbackResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->size(TextSize::Large)
                    ->columnSpanFull(),
                Section::make('Device Information')
                    ->collapsible()
                    ->schema([
                        // Sadly, we can't make use of the KeyValueEntry component: https://filamentphp.com/docs/3.x/infolists/entries/key-value
                        // due to the json have nested arrays
                        TextEntry::make('device_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) {
                                    return '';
                                }

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) {
                                    return $state;
                                }

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
                                if (!$state) {
                                    return '';
                                }

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) {
                                    return $state;
                                }

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
                Section::make('Platform Information')
                    ->collapsible()
                    ->schema([
                        TextEntry::make('platform_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) {
                                    return '';
                                }

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) {
                                    return $state;
                                }

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
                        TextEntry::make('additional_info')
                            ->label(false)
                            ->formatStateUsing(function ($state) {
                                if (!$state) {
                                    return '';
                                }

                                $decodedInfo = json_decode($state, true);
                                if (!$decodedInfo) {
                                    return $state;
                                }

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

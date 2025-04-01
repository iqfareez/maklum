<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Models\Feedback;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('public_id')
                    ->label('Feedback ID')
                    ->searchable()
                    ->badge()
                    ->color('primary'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y h:i A')
                    ->sortable()
                    ->wrap()
                    ->weight(fn ($record) => $record->created_at->isToday() ? FontWeight::Bold : null),
                Tables\Columns\TextColumn::make('message')
                    ->limit(65)
                    ->wrap()
                    ->html(),
                Tables\Columns\TextColumn::make('email')
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->defaultSort('created_at', 'desc')
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->url(fn(Feedback $record) => FeedbackResource::getUrl('view', ['record' => $record])),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageFeedback::route('/'),
            'view' => Pages\ViewFeedback::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}

<?php

namespace App\Filament\Resources;

use App\Models\Reservasi;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\ForceDeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ReservasiResource\Pages;

class ReservasiResource extends Resource
{
    protected static ?string $model = Reservasi::class;
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Data Reservasi';
    protected static ?string $navigationGroup = 'Manajemen Reservasi';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('user_id')
                ->label('User')
                ->options(User::pluck('name', 'id'))
                ->searchable()
                ->required(),

            Select::make('ruangan')
                ->options([
                    'Reguler' => 'Reguler',
                    'VIP' => 'VIP',
                ])
                ->required(),

            DatePicker::make('tanggal')->required(),

            TimePicker::make('jam_mulai')->required(),

            TextInput::make('durasi')
                ->numeric()
                ->required()
                ->label('Durasi (jam)'),

            TimePicker::make('jam_selesai')->required(),

            Select::make('status')
                ->options([
                    'pending' => 'Menunggu',
                    'approved' => 'Disetujui',
                    'rejected' => 'Ditolak',
                ])
                ->label('Status')
                ->required(),

        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('User')->sortable()->searchable(),
                TextColumn::make('ruangan')->searchable(),
                TextColumn::make('tanggal')->date(),
                TextColumn::make('jam_mulai')->label('Jam Mulai'),
                TextColumn::make('durasi')->label('Durasi (jam)'),
                TextColumn::make('jam_selesai')->label('Jam Selesai'),
                BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => 'Tidak Diketahui',
                    }),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),      // Soft Delete
                ForceDeleteAction::make(), // Hard Delete
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservasis::route('/'),
            'create' => Pages\CreateReservasi::route('/create'),
            'edit' => Pages\EditReservasi::route('/{record}/edit'),
        ];
    }
}

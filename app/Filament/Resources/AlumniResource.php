<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlumniResource\Pages;
use App\Filament\Resources\AlumniResource\RelationManagers;
use App\Models\Alumni;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlumniResource extends Resource
{
    protected static ?string $model = Alumni::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required(),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('angkatan')
                    ->options([
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('pekerjaan'),
                Forms\Components\TextInput::make('kontak'),
                Forms\Components\Textarea::make('alamat')->rows(3),
                Forms\Components\FileUpload::make('foto')
                    ->directory('alumni-fotos')
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        '1:1',
                    ]),
                Forms\Components\Select::make('jurusan')
                    ->options([
                        'Rekayasa Perangkat Lunak' => 'Rekayasa Perangkat Lunak',
                        'Teknik Komputer Jaringan' => 'Teknik Komputer Jaringan',
                        'Teknik Audio Video' => 'Teknik Audio Video',
                        'Teknik Mesin' => 'Teknik Mesin',
                        'Teknik Sepeda Motor' => 'Teknik Sepeda Motor',
                        'Teknik Kendaraan Ringan' => 'Teknik Kendaraan Ringan',
                        'Teknik Instalasi Tenaga Listrik' => 'Teknik Instalasi Tenaga Listrik',
                        'Desain Pemodelan dan Informasi Bangunan' => 'Desain Pemodelan dan Informasi Bangunan',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->searchable(),
                Tables\Columns\TextColumn::make('jenis_kelamin'),
                Tables\Columns\TextColumn::make('angkatan')->searchable(),
                Tables\Columns\TextColumn::make('pekerjaan'),
                Tables\Columns\TextColumn::make('kontak'),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\ImageColumn::make('foto')
                    ->disk('public')
                    ->directory('alumni-fotos')
                    ->label('Foto')
                    ->circular(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jurusan')
                    ->options([
                        'Rekayasa Perangkat Lunak' => 'Rekayasa Perangkat Lunak',
                        'Teknik Komputer Jaringan' => 'Teknik Komputer Jaringan',
                        'Teknik Audio Video' => 'Teknik Audio Video',
                        'Teknik Mesin' => 'Teknik Mesin',
                        'Teknik Sepeda Motor' => 'Teknik Sepeda Motor',
                        'Teknik Kendaraan Ringan' => 'Teknik Kendaraan Ringan',
                        'Teknik Instalasi Tenaga Listrik' => 'Teknik Instalasi Tenaga Listrik',
                        'Desain Pemodelan dan Informasi Bangunan' => 'Desain Pemodelan dan Informasi Bangunan',
                    ]),
                Tables\Filters\SelectFilter::make('angkatan')
                    ->options([
                        '2020' => '2020',
                        '2021' => '2021',
                        '2022' => '2022',
                        '2023' => '2023',
                        '2024' => '2024',
                        '2025' => '2025',
                    ]),
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAlumnis::route('/'),
            'create' => Pages\CreateAlumni::route('/create'),
            'edit' => Pages\EditAlumni::route('/{record}/edit'),
        ];
    }
}

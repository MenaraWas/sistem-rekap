<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlatformResource\Pages;
use App\Models\Platform;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PlatformResource extends Resource
{
    protected static ?string $model = Platform::class;

    protected static ?string $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'Kelola Platform';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nama Platform')
                    ->required(),
                TextInput::make('code')
                    ->label('Kode (slug)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->helperText('Contoh: kemenag_bantul'),
                TextInput::make('domain')
                    ->label('Domain Website')
                    ->helperText('Contoh: bantul.kemenag.go.id'),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'social_media' => 'Sosial Media',
                        'news_portal' => 'Portal Berita',
                    ])
                    ->required(),
                TextInput::make('icon')
                    ->label('Ikon Heroicon')
                    ->default('heroicon-o-document-text')
                    ->helperText('Contoh: heroicon-o-globe-alt'),
                TextInput::make('title_selector')
                    ->label('CSS Selector Judul')
                    ->helperText('Contoh: h1.post-title atau meta[property="og:title"]'),
                TextInput::make('date_selector')
                    ->label('CSS Selector Tanggal')
                    ->helperText('Contoh: .post-meta .post-created'),
                TextInput::make('date_format')
                    ->label('Format Tanggal')
                    ->helperText('Format PHP, contoh: m/d/Y atau d F Y. Kosongkan untuk ISO 8601.'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('code')->label('Kode')->badge(),
                TextColumn::make('domain')->label('Domain'),
                TextColumn::make('category')->label('Kategori')->badge(),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlatforms::route('/'),
            'create' => Pages\CreatePlatform::route('/create'),
            'edit' => Pages\EditPlatform::route('/{record}/edit'),
        ];
    }
}

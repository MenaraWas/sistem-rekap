<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->required(),
                TextInput::make('link')->url()->required(),
                DatePicker::make('date_posted')->required(),
                Select::make('category')
                    ->options([
                        'social_media' => 'Sosial Media',
                        'news_portal' => 'Portal Berita',
                    ])->required(),
                Select::make('platform')
                    ->options([
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                        'threads' => 'Threads',
                        'twitter' => 'Twitter',
                        'tiktok' => 'TikTok',
                        'kompasiana' => 'Kompasiana',
                        'retizen' => 'Retizen',
                        'telik_sandi' => 'Telik Sandi',
                        'man_2_bantul' => 'MAN 2 Bantul',
                    ])->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('title')->searchable(),
                TextColumn::make('link')->limit(50),
                TextColumn::make('date_posted')->date(),
                TextColumn::make('category')->badge(),
                TextColumn::make('platform')->badge(),
            ])
            ->filters([
                //
                 SelectFilter::make('category')
                    ->options([
                        'social_media' => 'Sosial Media',
                        'news_portal' => 'Portal Berita',
                    ]),
                SelectFilter::make('platform')
                    ->options([
                        'instagram' => 'Instagram',
                        'facebook' => 'Facebook',
                        'threads' => 'Threads',
                        'twitter' => 'Twitter',
                        'tiktok' => 'TikTok',
                        'kompasiana' => 'Kompasiana',
                        'retizen' => 'Retizen',
                        'telik_sandi' => 'Telik Sandi',
                        'man_2_bantul' => 'MAN 2 Bantul',
                    ]),
            ])
            ->defaultSort('date_posted', 'desc')
            
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}

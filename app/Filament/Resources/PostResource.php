<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live()
                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                        if (($get('slug') ?? '') !== Str::slug($old)) {
                            return;
                        }
                    
                        $set('slug', Str::slug($state));
                    }),
                    RichEditor::make('short_content'),
                    RichEditor::make('content'),
                    Select::make('categories')
                    ->multiple()
                    ->relationship('categories','name')
                    ->preload(),
                    Select::make('materials')
                    ->multiple()
                    ->relationship('materials','name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Select::make('type')
                            ->options([
                                 '0' => 'file',
                                 '1' => 'youtube'
                            ])
                            ->live()
                            ->afterStateUpdated(fn (Select $component) => $component
                            ->getContainer()
                            ->getComponent('dynamicTypeFields')
                            ->getChildComponentContainer()
                            ->fill()),
                        Section::make()
                        ->schema(fn (Get $get): array => match ($get('type')) {
                            '0' => [
                                FileUpload::make('filename')
                                ->preserveFilenames()
                                ->storeFileNamesIn('attachment_file_names')
                                ->uploadButtonPosition('left')
                                ->uploadProgressIndicatorPosition('left')
                            ],
                           
                            '1' => [
                                Forms\Components\TextInput::make('url'),
                        ],
                            default => [
                            ],
                            })
                            ->key('dynamicTypeFields')
                        ])
                    ->preload(),
                    Select::make('tags')
                    ->multiple()
                    ->relationship('tags','name')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                    ])
                    ->preload(),
                    Forms\Components\TextInput::make('url')
                    ->maxLength(255),
                    ])->columns(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
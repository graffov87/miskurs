<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPost extends EditRecord
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }


    protected function getSavedNotificationTitle(): ?string
    {
        return 'Post updated';
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated from the database.
    }
    
    public function mount(int | string $record): void
    {
    parent::mount($record);
    if (empty($this->getRecord()->url)) {
       $this->form->fill([
           'url' => strtolower(str_replace(" ","-",trim($this->getRecord()->title))),
       ]);
    }
   }
}
<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

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
        return 'Page updated';
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
                'url' => strtolower(str_replace(" ", "-", trim($this->getRecord()->title))),
            ]);
        }
    }
}

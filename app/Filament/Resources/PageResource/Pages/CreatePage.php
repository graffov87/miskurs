<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Page created';
    }

    public function mount(): void
    {

        if (empty($this->page->url) && !empty($this->page->title)) {
            $this->form->fill([
                'url' => strtolower(str_replace(" ", "-", trim($this->page->title))),
            ]);
        }
    }
}

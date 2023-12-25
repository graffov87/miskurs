<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePost extends CreateRecord
{
    protected static string $resource = PostResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Post created';
    }

    public function mount(): void
 {

    if (empty($this->post->url)) {
        $this->form->fill([
            'url' => strtolower(str_replace(" ","-",trim($this->post->title))),
        ]);
     }
}
}
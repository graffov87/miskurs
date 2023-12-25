<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class EditProfile extends Page implements Hasforms
{
    use InteractsWithForms;

    public ?array $data = [];
 
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Profile';

    protected static string $view = 'filament.pages.edit-profile';

    protected function getFormActions(): array {
        return [
            Action::make('save')
            ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
            ->submit('save')
        ];
    }

    public function mount(): void 
    {
        $this->form->fill(auth()->user()->profile->attributesToArray());
    }


    public function form(Form $form): Form {

        return $form->schema([
            Section::make()->schema([
                Forms\Components\TextInput::make('first_name')
                ->required(),
                Forms\Components\TextInput::make('last_name')
                ->required(),
                DatePicker::make('dob'),
                FileUpload::make('avatar')
                ->avatar()
            //    ->disk('upload')
               ->directory('avatars')
               ->preserveFilenames()
               ->storeFileNamesIn('attachment_file_names')
               ->uploadButtonPosition('left')
               ->uploadProgressIndicatorPosition('left')
            ])

        ])
        ->statePath('data');
    }

    public function save(): void {
        try {
            $data = $this->form->getState();

            auth()->user()->profile->update($data);

        } catch(Halt $exception) {
            return;
        }

        Notification::make()
        ->success()
        ->title('Saved successfully')
        ->send();
    }
}
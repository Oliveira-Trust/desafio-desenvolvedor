<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Create extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected function getFormModel(): string
    {
        return User::class;
    }

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Components\TextInput::make('name')
                ->label('Nome')
                ->maxLength(50)
                ->required(),
            Components\TextInput::make('email')
                ->label('Email')
                ->unique()
                ->maxLength(50)
                ->email()
                ->required(),
            Components\TextInput::make('password')
                ->label('Senha')
                ->minLength(6)
                ->maxLength(50)
                ->password()
                ->required(),
            Components\Checkbox::make('admin')
                ->label('Administrador'),
        ];
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $form = $this->form->getState();
        $form['password'] = bcrypt($form['password']);

        User::create($form);

        Notification::make()
            ->title('Usuário adicionado com sucesso!')
            ->success()
            ->send();

        return redirect()->route('users.index');
    }

    public function render(): View
    {
        return view('livewire.users.create');
    }
}

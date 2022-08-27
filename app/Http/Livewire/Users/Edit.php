<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;

class Edit extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public User $user;

    protected function getFormModel(): User
    {
        return $this->user;
    }

    public function mount($id): void
    {
        $this->user = User::findOrFail($id);

        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'admin' => $this->user->id === 1
                ? $this->user->admin
                : ''
        ]);
    }

    protected function getFormSchema(): array
    {
        $form = [
            Components\TextInput::make('name')
                ->label('Nome')
                ->required(),
            Components\TextInput::make('email')
                ->label('Email')
                ->unique('users', 'email', $this->user)
                ->email()
                ->required(),
            Components\TextInput::make('password')
                ->label('Senha')
                ->password()
                ->required(),
        ];

        if ($this->user->id !== 1) {
            array_push(
                $form,
                Components\Checkbox::make('admin')
                    ->label('Administrador')
            );
        }

        return $form;
    }

    public function submit(): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
       $this->user->fill($this->form->getState())->save();

        Notification::make()
            ->title('Informações do usuário atualizadas com sucesso!')
            ->success()
            ->send();

        return redirect()->route('users.index');
    }
    public function render(): View
    {
        return view('livewire.users.edit');
    }
}

<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Register extends Component
{
    #[Validate('required|max:255')]
    public ?string $name = null;
    #[Validate('required|max:255|email')]
    public ?string $email = null;
    #[Validate('required')]
    public ?string $password = null;
    public ?string $email_confirmation = null;

    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit(): void
    {
        $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
        auth()->login($user);
        $this->redirectRoute('home');
    }
}

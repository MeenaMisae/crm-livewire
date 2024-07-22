<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class Register extends Component
{
    public ?string $name;
    public ?string $email;
    public ?string $password;
    public ?string $email_confirmation;

    public function render(): View
    {
        return view('livewire.auth.register');
    }

    public function submit(): void
    {
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
}

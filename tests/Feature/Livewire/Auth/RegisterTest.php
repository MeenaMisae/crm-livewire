<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    \Pest\Laravel\assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ]);

    \Pest\Laravel\assertDatabaseCount('users', 1);
});
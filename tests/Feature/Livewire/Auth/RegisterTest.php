<?php

use App\Livewire\Auth\Register;
use App\Models\User;
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
        ->assertHasNoErrors()
        ->assertRedirect(route('home'));

    \Pest\Laravel\assertDatabaseHas('users', [
        'name' => 'Test User',
        'email' => 'test@example.com'
    ]);

    \Pest\Laravel\assertDatabaseCount('users', 1);

    expect(auth()->check())->and(auth()->user())->id->toBe(User::first()->id);
});

test('validation rules', function ($data) {
    Livewire::test(Register::class)
        ->set($data->field, $data->value)
        ->call('submit')
        ->assertHasErrors([$data->field => $data->rule]);
})->with([
    'name::required' => (object)['field' => 'name', 'value' => '', 'rule' => 'required'],
    'name::max:255' => (object)['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max'],
    'email::required' => (object)['field' => 'email', 'value' => '', 'rule' => 'required'],
    'email::email' => (object)['field' => 'email', 'value' => 'wrong-email', 'rule' => 'email'],
    'email::max:255' => (object)['field' => 'email', 'value' => str_repeat('*' . '@example.com', 256), 'rule' => 'max'],
    'password::required' => (object)['field' => 'password', 'value' => '', 'rule' => 'required'],
    ]); 
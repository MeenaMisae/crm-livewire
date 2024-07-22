<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

it('should render the component', function () {
    Livewire::test(Register::class)
    ->assertOk();
});
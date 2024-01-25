<?php

use App\Enums\UserStatus;
use App\Enums\UserSupportLevel;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

beforeEach(function () {
    Artisan::call('migrate');
});

it('should authenticate a user', function () {
    $user = User::factory()->create();
    $response = $this->postJson('/api/auth/login', [
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'token_type' => 'Bearer',
            'expires_in' => 60 * 60,
        ]);
});

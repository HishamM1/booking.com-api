<?php

use App\Models\Role;

it('should fails with admin role', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'Admin',
        'email' => 'admin@admin.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role_id' => Role::ROLE_ADMIN,
    ]);

    expect($response->status())->toBe(422);
});

it('should succeeds with owner role', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'owner',
        'email' => 'owner@owner.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role_id' => Role::ROLE_PROPERTY_OWNER,
    ]);

    $response->assertJsonStructure(['token']);
});

it('should succeeds with user role', function () {
    $response = $this->postJson('/api/auth/register', [
        'name' => 'user',
        'email' => 'user@user.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role_id' => Role::ROLE_USER,
    ]);

    $response->assertJsonStructure(['token']);
});





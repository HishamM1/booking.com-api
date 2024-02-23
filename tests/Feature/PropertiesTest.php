<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
    $this->seed(PermissionSeeder::class);
});

it('should give the owner the ability to manage properties', function () {
    $owner = User::factory()->create([
        'role_id' => Role::ROLE_PROPERTY_OWNER,
    ]);

    $response = $this->actingAs($owner)->getJson('/api/owner/properties');

    $response->assertJson([
        'message' => 'You are viewing properties as an owner',
    ]);
});

it('should not give the user the ability to manage properties', function () {
    $user = User::factory()->create([
        'role_id' => Role::ROLE_USER,
    ]);

    $response = $this->actingAs($user)->get('/api/owner/properties');

    $response->assertStatus(403);
});

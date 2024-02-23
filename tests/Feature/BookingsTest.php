<?php

use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;

beforeEach(function () {
    $this->seed(RoleSeeder::class);
    $this->seed(PermissionSeeder::class);
});

it('should give the user the ability to manage properties', function () {
    $user = User::factory()->create([
        'role_id' => Role::ROLE_USER,
    ]);

    $response = $this->actingAs($user)->getJson('/api/user/bookings');

    $response->assertStatus(200);
});

it('should not give the owner the ability to manage bookings', function () {
    $owner = User::factory()->create([
        'role_id' => Role::ROLE_PROPERTY_OWNER,
    ]);

    $response = $this->actingAs($owner)->get('/api/user/bookings');

    $response->assertStatus(403);
});

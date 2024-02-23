<?php

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;

beforeEach(function () {
    $this->seed();
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

it('should store a property', function () {
    $owner = User::factory()->create([
        'role_id' => Role::ROLE_PROPERTY_OWNER,
    ]);

    $response = $this->actingAs($owner)->postJson('/api/owner/properties', [
        'name' => 'My property',
        'city_id' => City::value('id'),
        'address_street' => 'Street Address 1',
        'address_postcode' => '12345',
    ]);

    $response->assertSuccessful();
    $response->assertJsonFragment(['name' => 'My property']);
});

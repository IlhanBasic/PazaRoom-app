<?php

namespace Database\Factories;

use App\Models\Role; // Uveri se da koristiš model Role
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Pretpostavljam da 'role' je povezan sa tabelom 'roles'
        $role = Role::inRandomOrder()->first(); // Random uloga korisnika

        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => static::$password ??= Hash::make('password'), // Definisana osnovna lozinka
            'role_id' => $role->id, // Dodavanje veze sa ulogom
        ];
    }

    /**
     * Indicate that the model should have the 'Student' role.
     */
    public function student(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'Student')->first()->id,
        ]);
    }

    /**
     * Indicate that the model should have the 'Vlasnik' role.
     */
    public function vlasnik(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'Vlasnik')->first()->id,
        ]);
    }

    /**
     * Indicate that the model should have the 'Administrator' role.
     */
    public function administrator(): static
    {
        return $this->state(fn (array $attributes) => [
            'role_id' => Role::where('name', 'Administrator')->first()->id,
        ]);
    }
}

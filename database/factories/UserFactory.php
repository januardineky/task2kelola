<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'rolename' => 'User',
            'status' => 0,
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'major' => fake()->randomElement([
                'Rekayasa Perangkat Lunak',
                'Teknik Komputer Jaringan',
                'Teknik Elektronika Industri',
                'Desain Komunikasi Visual',
                'Desain Pemodelan dan Informasi Bangunan',
                'Teknik Sepeda Motor',
                'Teknik Kendaraan Ringan'
            ]),
        ];
        
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

<?php

namespace Database\Factories\UserManagement;

use App\Models\UserManagement\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserManagement\User>
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = User::class;

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
        static $usedEmails = [];

        $faker = fake('id_ID');
        $gender = $faker->randomElement(['male', 'female']);
        $firstName = $faker->firstName($gender);
        $lastName = $faker->lastName($gender);
        $name = trim("{$firstName} {$lastName}");

        // Generate email yang disamakan persis dengan nama pengguna
        $nameSlug = Str::slug($name, '.');
        $domain = $faker->randomElement(['gmail.com', 'yahoo.com', 'outlook.com', 'mail.com']);
        $candidateEmail = "{$nameSlug}@{$domain}";

        if (isset($usedEmails[$candidateEmail])) {
            $counter = ++$usedEmails[$candidateEmail];
            $email = "{$nameSlug}{$counter}@{$domain}";
        } else {
            $usedEmails[$candidateEmail] = 1;
            $email = $candidateEmail;
        }

        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

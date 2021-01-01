<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$WBvsXTRcOPsrxJod94EpJ.ad/SIX.VwYXAaDFQihy0/kbgX5TxGSS', // password
            'remember_token' => Str::random(10),
            'image' => UploadedFile::fake()->image('avatar.jpg')->path()
        ];
    }
}

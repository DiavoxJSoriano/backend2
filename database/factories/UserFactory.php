<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->truncate();
        $name_first = $this->faker->firstName;
        $name_last = $this->faker->lastName;
        $name = $name_first . " " .$name_last;
        $username = Str::lower(substr($name_first, 0, 1)) . Str::lower($name_last);
        $email = Str::lower(substr($name_first, 0, 1)) . Str::lower($name_last) . "@example.org";

        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'password' => bcrypt('P@ssw0rd'), // password
            'remember_token' => Str::random(10),
            'name_first' => $name_first,
            'name_last' => $name_last,
            'address' => $this->faker->address,
            'username' => $username,
            'postcode' => $this->faker->postcode,
            'contact_phone' => $this->faker->phoneNumber,
        ];
    }
}

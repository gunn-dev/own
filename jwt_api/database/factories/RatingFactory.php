<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rating' => $this->faker->randomFloat(null, 0, 10),
            'user_id' => User::factory(),
            'book_id' => Book::factory()
        ];
    }
}

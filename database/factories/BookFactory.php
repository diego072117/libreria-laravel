<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Book::class;

    public function authorId($author)
    {
        return $this->state([
            'author_id' => $author->id,
        ]);
    }

    public function definition()
    {
        return [
            'category_id' => $this->faker->randomElement([1,2,3]),
            'title' => $this->faker->sentence(),
            'stock' => $this->faker->randomDigit(),
            'description' => $this->faker->paragraph(),
        ];
    }
}

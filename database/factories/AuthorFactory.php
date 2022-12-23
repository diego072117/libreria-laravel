<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Author::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->paragraph(),
        ];
    }


    public function configure(){
        
        return $this->afterCreating(function (Author $author){
            Book::factory(2)->authorId($author)->create();
        });

    }
}

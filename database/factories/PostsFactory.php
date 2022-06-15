<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = ['Teknologi', 'Otomotif', 'Kuliner', 'Wisata', 'Pemerintahan'];
        $status = ['Publish', 'Draft', 'Trash'];
        return [
            'title' => $this->faker->sentence(mt_rand(5,10)),
            'content' => $this->faker->paragraph(50,100),
            'category' => $category[mt_rand(0,4)],
            'status' => $status[mt_rand(0,2)],
        ];
    }
}

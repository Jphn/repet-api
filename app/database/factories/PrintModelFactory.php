<?php

namespace App\Database\Factories;

use App\Models\PrintModel;
use App\Models\User;

class PrintModelFactory extends Factory
{
	public $model = PrintModel::class;

	/**
	 * Create the blueprint for your factory
	 * @return array
	 */
	public function definition(): array
	{
		$name = $this->faker->unique()->word();

		return [
			'user_id' => User::all()->random()->id,
			'name' => $name,
			'description' => $this->faker->text(),
			'cost' => $this->faker->numberBetween(0, 100),
			'credits' => $this->faker->name() . " " . $this->faker->lastName(),
			'private' => $this->faker->boolean(),
			'approved' => $this->faker->boolean(90),
			'folder' => time() . '_' . $name . '_' . substr(md5($name), 0, 8),
		];
	}
}

<?php

namespace Database\Factories;

use Hash;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{

    protected $model = Shop::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $floor = rand(1,15);
        $shoplot = rand(1,200);

        $data = [
            'name' => $name,
            'floor' => $floor,
            'shoplot' => $shoplot
        ];

        return [
            'name' => $name,
            'floor' => $floor,
            'shoplot' => $shoplot,
            'hash' => $this->generateHash($data)
        ];
    }

    public function generateHash($shop)
    {
        $data = serialize($shop['name'] . $shop['floor'] . $shop['shoplot']);

        $hash = Hash::make($data);

        return $hash;
    }

}

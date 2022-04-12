<?php

namespace Database\Factories;

use App\Enums\TicketTypeEnum;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(100),
            'content' => $this->faker->text(255),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function bug()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TicketTypeEnum::BUG
            ];
        });
    }

    public function featureRequest()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TicketTypeEnum::FEATURE_REQUEST
            ];
        });
    }

    public function testCase()
    {
        return $this->state(function (array $attributes) {
            return [
                'type' => TicketTypeEnum::TEST_CASE
            ];
        });
    }

    public function createdByQA()
    {
        return $this->for(
            User::factory()->qa(),
            'creator'
        );
    }

    public function resolvedByRD()
    {
        $newInstance = $this->for(
            User::factory()->rd(),
            'resolver'
        );
        return $newInstance->state(function (array $attributes) {
            return [
                'resolved_at' => Carbon::now()
            ];
        });
    }
}

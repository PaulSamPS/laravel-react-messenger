<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
//class MessageFactory extends Factory
//{
//    /**
//     * Define the model's default state.
//     *
//     * @return array<string, mixed>
//     */
//    public function definition(): array
//    {
//        $senderId = $this->faker->randomElement([0, 1]);
//
//        if ($senderId === 0) {
//            $senderId == $this->faker->randomElement(User::query()->where('id', '!=', 1)->pluck('id')->toArray());
//            $receiverId = 1;
//        } else {
//            $receiverId = $this->faker->randomElement(User::query()->pluck('id')->toArray());
//        }
//
//        $groupId = null;
//
//        if ($this->faker->boolean(50)) {
//            $groupId = $this->faker->randomElement(Group::query()->pluck('id')->toArray());
//            $group = Group::query()->find($groupId);
//            $senderId = $this->faker->randomElement($group->users->pluck('id')->toArray());
//            $receiverId = null;
//        }
//
//        return [
//            'sender_id' => $senderId,
//            'receiver_id' => $receiverId,
//            'group_id' => $groupId,
//            'message' => $this->faker->realText(200),
//            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
//        ];
//    }
//}

class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $senderId = $this->faker->randomElement(User::query()->pluck('id')->toArray());

        $receiverId = $this->faker->randomElement(
            User::query()->where('id', '!=', $senderId)->pluck('id')->toArray()
        );

        $groupId = null;

        if ($this->faker->boolean(50)) {
            $groupId = $this->faker->randomElement(Group::query()->pluck('id')->toArray());
            $group = Group::query()->find($groupId);
            $senderId = $this->faker->randomElement($group->users->pluck('id')->toArray());
            $receiverId = null;
        }

        return [
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
            'group_id' => $groupId,
            'message' => $this->faker->realText(200),
            'created_at' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
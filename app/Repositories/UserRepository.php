<?php

namespace BookingSystem\Repositories;

defined('ABSPATH') || exit;

class UserRepository
{
    public function find(int $userId): ?\WP_User
    {
        $user = get_user_by(
            'ID',
            $userId
        );

        return $user ?: null;
    }

    public function exists(int $userId): bool
    {
        return $this->find($userId) !== null;
    }

    public function isPremium(
        int $userId
    ): bool {

        $plan = get_user_meta(
            $userId,
            'booking_plan',
            true
        );

        return $plan === 'premium';
    }

    public function getPlan(
        int $userId
    ): string {

        return get_user_meta(
            $userId,
            'booking_plan',
            true
        ) ?: 'standard';
    }

    public function setPlan(
        int $userId,
        string $plan
    ): bool {

        return (bool) update_user_meta(
            $userId,
            'booking_plan',
            $plan
        );
    }

    public function getDisplayName(
        int $userId
    ): string {

        $user = $this->find($userId);

        return $user
            ? $user->display_name
            : '';
    }

    public function getEmail(
        int $userId
    ): string {

        $user = $this->find($userId);

        return $user
            ? $user->user_email
            : '';
    }
}
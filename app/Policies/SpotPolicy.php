<?php

namespace App\Policies;

use App\Models\Spot;
use App\Models\User;

class SpotPolicy
{
    public function view(User $user, Spot $spot): bool
    {
        return $spot->user_id === $user->id;
    }

    public function update(User $user, Spot $spot): bool
    {
        return $spot->user_id === $user->id;
    }

    public function delete(User $user, Spot $spot): bool
    {
        return $spot->user_id === $user->id;
    }
}

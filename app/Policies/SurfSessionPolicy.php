<?php

namespace App\Policies;

use App\Models\SurfSession;
use App\Models\User;

class SurfSessionPolicy
{
    public function view(?User $user, SurfSession $surfSession): bool
    {
        return !$surfSession->spot->is_private || $user?->id === $surfSession->user_id;
    }

    public function update(User $user, SurfSession $surfSession): bool
    {
        return $surfSession->user_id === $user->id;
    }

    public function delete(User $user, SurfSession $surfSession): bool
    {
        return $surfSession->user_id === $user->id;
    }
}

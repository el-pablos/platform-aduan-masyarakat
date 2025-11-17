<?php

if (!function_exists('dashboard_route')) {
    /**
     * Get the dashboard route based on user role
     *
     * @param \App\Models\User|null $user
     * @return string
     */
    function dashboard_route($user = null)
    {
        $user = $user ?? auth()->user();

        if (!$user) {
            return route('login');
        }

        if ($user->role === 'warga') {
            return route('laporan.index');
        }

        return route('admin.dashboard');
    }
}


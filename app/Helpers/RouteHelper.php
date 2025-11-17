<?php

if (!function_exists('dashboard_route')) {
    /**
     * Get the dashboard route based on user role
     *
     * @return string
     */
    function dashboard_route()
    {
        $user = auth()->user();
        
        if (!$user) {
            return route('login');
        }
        
        if ($user->role === 'warga') {
            return route('laporan.index');
        }
        
        return route('admin.dashboard');
    }
}


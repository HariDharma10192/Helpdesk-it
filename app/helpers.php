<?php

if (!function_exists('getRoleName')) {
    function getRoleName($role_id)
    {
        switch ($role_id) {
            case 1:
                return 'Admin';
            case 2:
                return 'User';
            case 3:
                return 'Department';
            default:
                return null;
        }
    }
}

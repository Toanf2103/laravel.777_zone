<?php

namespace App\Services\Site;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function createWithSocial($data)
    {
        try {
            $newUser = User::create(
                [
                    'email' => $data['email'],
                    'role' => 'customer',
                    'full_name' => $data['name'],
                    'avatar' => $data['avatar'],
                    'google_id' =>$data['google_id']
                ]
            );
            return $newUser;
        } catch (Exception $e) {
            return false;
        }
    }
}

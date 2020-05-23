<?php

namespace HotelFactory\Managers;

use HotelFactory\Models\User;

class UserManager extends Manager
{
    public function __construct()
    {
        parent::__construct(User::class, 'User');
    }
}
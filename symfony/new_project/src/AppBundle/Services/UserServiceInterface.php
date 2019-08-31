<?php


namespace AppBundle\Services;


use AppBundle\Entity\User;

interface UserServiceInterface
{
public function register(User $user) : bool;
}

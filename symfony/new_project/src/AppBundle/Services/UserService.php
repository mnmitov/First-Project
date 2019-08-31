<?php


namespace AppBundle\Services;


use AppBundle\Entity\User;

class UserService implements UserServiceInterface
{

  public function register(User $user): bool
  {
    return true;
  }
}

<?php

namespace App\UserAge;

class IsAdult
{
  public function isAdult($age)
  {
      return $age >= 18;
  }
}

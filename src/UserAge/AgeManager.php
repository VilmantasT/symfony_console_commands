<?php

namespace App\UserAge;

use App\UserAge\UserAgeCalculator;
use App\UserAge\IsAdult;

class AgeManager
{
  private $userAge;
  private $adulthood;

  public function __construct(UserAgeCalculator $userAge, IsAdult $adult)
  {
    $this->userAge = $userAge;
    $this->adulthood = $adult;
  }

  public function getUserAge($birthday):int
  {
    return $this->userAge->getAge($birthday);
  }

  public function isUserAdult($age):bool
  {
    return $this->adulthood->isAdult($age);
  }
}

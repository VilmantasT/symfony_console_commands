<?php


namespace App\UserAge;

use DateTime;





class UserAgeCalculator
{
    public function getAge($birthday)
    {

        $day = new DateTime();
        $birthday = new DateTime($birthday);

        $age = $birthday->diff($day)->y;

        return $age;
    }

    public function isAdult($age)
    {
        return $age >= 18;
    }
}
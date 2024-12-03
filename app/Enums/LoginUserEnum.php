<?php
namespace App\Enums ;

use Illuminate\Validation\Rules\Enum;


/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
*/

class LoginUserEnum extends Enum{

    const ACCOUNT_DOES_NOT_EXIST ='1';
    const WRONG_PASSWORD ='2';
}

<?php
/**
 * Created by PhpStorm.
 * User: petrux
 * Date: 17/12/18
 * Time: 17.45.
 */

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class HashPasswordCompare extends Constraint
{
    public $message = 'Login failed';
}

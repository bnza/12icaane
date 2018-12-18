<?php
/**
 * Created by PhpStorm.
 * User: petrux
 * Date: 17/12/18
 * Time: 17.47.
 */

namespace App\Validator\Constraints;

use App\Security\VerySimpleLogin;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

class HashPasswordCompareValidator extends ConstraintValidator
{
    private $login;

    public function __construct(VerySimpleLogin $login)
    {
        $this->login = $login;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof HashPasswordCompare) {
            throw new UnexpectedTypeException($constraint, HashPasswordCompare::class);
        }

        if (!is_string($value)) {
            throw new UnexpectedValueException($value, 'string');
        }

        if (!$this->login->authenticate($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}

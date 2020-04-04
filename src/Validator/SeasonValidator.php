<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class SeasonValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint Season */
        if (!$constraint instanceof Season) {
            throw new UnexpectedTypeException($constraint, Season::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $year1 = substr($value, 0, 4);
        $year1end = substr($value, 2, 4);
        $year2 = substr($value, 5, 2);
        $delimiter = substr($value, 4, 1);

        if (
            !is_int(intval($year1)) ||
            !is_int(intval($year2)) ||
            (intval($year2) - intval($year1end) !== 1) ||
            $delimiter !== '-'
        ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}

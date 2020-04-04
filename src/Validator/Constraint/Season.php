<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Season extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'Season must be formatted like 1995-96.';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}

<?php
// src/Validator/Constraints/ContainsAlphanumeric.php
namespace App\Validator\Constraints;

use App\Entity\Task;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
* @Annotation
*/
class IsTaskPriorityValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($value < 0 || $value >  count(Task::PRIORITIES)){
            throw  new \OutOfRangeException($constraint->message);
        }
    }
}
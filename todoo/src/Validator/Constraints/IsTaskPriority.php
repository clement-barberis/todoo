<?php
// src/Validator/Constraints/ContainsAlphanumeric.php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class IsTaskPriority extends Constraint
{
    public $message = 'Vous devez saisir une priorité valide.';
}
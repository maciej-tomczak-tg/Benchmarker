<?php
/**
 * Created by PhpStorm.
 * User: morgan
 * Date: 14.02.16
 * Time: 16:39
 */

namespace BenchmarkerBundle\Validator\Constraint;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MultiUrlValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        if ($this->checkIsValid($value) === false) {
            $this->context->addViolation($constraint->message);
        }
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function checkIsValid($value)
    {
        $urls = explode("\n", $value);
        foreach ($urls as $url) {
            if (filter_var(trim($url), FILTER_VALIDATE_URL) === false) {
                return false;
            }
        }

        return true;
    }
}

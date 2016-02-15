<?php
/**
 * Created by PhpStorm.
 * User: morgan
 * Date: 14.02.16
 * Time: 16:37
 */

namespace BenchmarkerBundle\Validator\Constraint;


use Symfony\Component\Validator\Constraint;

class MultiUrl extends Constraint
{
    public $message = 'Must contain only valid urls separated by enter ex: http://google.pl';
}
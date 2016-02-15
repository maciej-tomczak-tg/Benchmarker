<?php
namespace BenchmarkerBundle\Sms;

interface SmsInterface
{
    /**
     * @return string
     */
    public function getNumber();

    /**
     * @return string
     */
    public function getBody();
}

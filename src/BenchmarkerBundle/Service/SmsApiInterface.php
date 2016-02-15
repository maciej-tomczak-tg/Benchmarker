<?php
/**
 * Created by PhpStorm.
 * User: morgan
 * Date: 10.02.16
 * Time: 21:33
 */

namespace BenchmarkerBundle\Service;


use BenchmarkerBundle\Sms\SmsInterface;

interface SmsApiInterface
{
    /**
     * @param SmsInterface $sms
     * @return mixed
     */
    public function send(SmsInterface $sms);
}

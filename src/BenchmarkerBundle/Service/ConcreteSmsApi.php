<?php

namespace BenchmarkerBundle\Service;

use BenchmarkerBundle\Sms\SmsInterface;
use BenchmarkerBundle\Sms\SmsSendException;

class ConcreteSmsApi implements SmsApiInterface
{

    /**
     * @param SmsInterface $sms
     *
     * @return bool
     *
     * @throws SmsSendException
     */
    public function send(SmsInterface $sms)
    {
        return $this->transport($sms->getNumber(), $sms->getBody());

    }

    /**
     * @param $number
     * @param $message
     * @return bool
     *
     * @throws SmsSendException
     */
    private function transport($number, $message) //dummy :)
    {
        //dummy method
        if (rand(1, 10) > 2) {
            return true;
        } else {
            throw new SmsSendException('Something went wrong during sending sms');
        }
    }
}

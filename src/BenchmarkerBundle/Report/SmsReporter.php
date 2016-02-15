<?php
/**
 * Created by PhpStorm.
 * User: morgan
 * Date: 14.02.16
 * Time: 17:33
 */

namespace BenchmarkerBundle\Report;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use BenchmarkerBundle\Factory\BenchmarkReportersFactory;
use BenchmarkerBundle\Service\SmsApiInterface;

class SmsReporter implements ReporterInterface
{
    /**
     * @var SmsApiInterface
     */
    private $smsApi;

    /**
     * @var
     */
    private $triggerRatio;
    /**
     * @var BenchmarkReportersFactory
     */
    private $benchmarkReportersFactory;
    /**
     * @var string
     */
    private $phoneNumber;

    public function __construct(
        SmsApiInterface $smsApi,
        BenchmarkReportersFactory
        $benchmarkReportersFactory,
        $triggerRatio,
        $phoneNumber
    ) {
        $this->smsApi = $smsApi;
        $this->benchmarkReportersFactory = $benchmarkReportersFactory;
        $this->triggerRatio = $triggerRatio;
        $this->phoneNumber = $phoneNumber;
    }

    public function sendReport(BenchmarkReportInterface $report)
    {
        $sms = $this->benchmarkReportersFactory->createReporterSmsMessage($report, $this->phoneNumber);
        try {
            $this->smsApi->send($sms);
        } catch (\Exception $e) {
            throw $e;
            //todo add logger like monotolog or do other stuff
        }

    }

    /**
     * @return int|float
     */
    public function getTriggerRatio()
    {
        return $this->triggerRatio;
    }

    /**
     * @param int|float $ratio
     *
     * @return $this
     */
    public function setTriggerRatio($ratio)
    {
        $this->triggerRatio = $ratio;

        return $this;
    }
}

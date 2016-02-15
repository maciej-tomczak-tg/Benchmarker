<?php

namespace BenchmarkerBundle\Factory;


use BenchmarkerBundle\Email\SiteIsSlowerEmail;
use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use BenchmarkerBundle\Sms\SiteIsSlowerSms;
use Symfony\Bundle\TwigBundle\TwigEngine;

class BenchmarkReportersFactory
{
    /**
     * @var TwigEngine
     */
    private $renderer;

    /**
     * @var string
     */
    private $emailTemplate;

    /**
     * @param TwigEngine $renderer
     * @param $emailTemplate
     */
    public function __construct(TwigEngine $renderer, $emailTemplate)
    {

        $this->renderer = $renderer;
        $this->emailTemplate = $emailTemplate;
    }

    /**
     * @param BenchmarkReportInterface $report
     * @param string $phoneNumber
     *
     * @return SiteIsSlowerSms
     */
    public function createReporterSmsMessage(BenchmarkReportInterface $report, $phoneNumber)
    {
        $sms = new SiteIsSlowerSms($report, $phoneNumber);

        return $sms;
    }

    /**
     * @param BenchmarkReportInterface $report
     * @param string $emailAddress
     *
     * @return SiteIsSlowerEmail
     */
    public function createReporterEmailMessage(BenchmarkReportInterface $report, $emailAddress)
    {
        $email = new SiteIsSlowerEmail($report, $this->renderer, $this->emailTemplate, $emailAddress);

        return $email;
    }
}
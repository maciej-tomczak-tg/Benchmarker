<?php

namespace BenchmarkerBundle\Report;


use BenchmarkerBundle\Email\EmailInterface;
use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use BenchmarkerBundle\Factory\BenchmarkReportersFactory;
use BenchmarkerBundle\Service\EmailService;

class EmailReporter implements ReporterInterface
{
    /**
     * @var EmailService
     */
    private $emailService;
    /**
     * @var EmailInterface
     */
    private $email;

    /**
     * @var float|int
     */
    private $triggerRatio;
    /**
     * @var BenchmarkReportersFactory
     */
    private $reportersFactory;

    /**
     * @param EmailService $emailService
     * @param BenchmarkReportersFactory $reportersFactory
     * @param $triggerRatio float
     * @param $email string
     */
    public function __construct(
        EmailService $emailService,
        BenchmarkReportersFactory
        $reportersFactory,
        $triggerRatio,
        $email
    ) {
        $this->emailService = $emailService;
        $this->triggerRatio = $triggerRatio;
        $this->reportersFactory = $reportersFactory;
        $this->email = $email;
    }

    public function sendReport(BenchmarkReportInterface $report)
    {
        $email = $this->reportersFactory->createReporterEmailMessage($report, $this->email);
        $this->emailService->send($email);
    }

    /**
     * @return float|int
     */
    public function getTriggerRatio()
    {
        return $this->triggerRatio;
    }

    /**
     * @param float|int $ratio
     * @return $this
     */
    public function setTriggerRatio($ratio)
    {
        $this->triggerRatio = $ratio;

        return $this;
    }
}

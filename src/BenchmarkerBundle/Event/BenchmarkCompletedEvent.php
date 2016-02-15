<?php

namespace BenchmarkerBundle\Event;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use Symfony\Component\EventDispatcher\Event;

class BenchmarkCompletedEvent extends Event
{
    /**
     * @var BenchmarkReportInterface
     */
    private $benchmarkReport;

    /**
     * @param BenchmarkReportInterface $benchmarkReport
     */
    public function __construct(BenchmarkReportInterface $benchmarkReport)
    {

        $this->benchmarkReport = $benchmarkReport;
    }

    /**
     * @return BenchmarkReportInterface
     */
    public function getBenchmarkReport()
    {
        return $this->benchmarkReport;
    }
}

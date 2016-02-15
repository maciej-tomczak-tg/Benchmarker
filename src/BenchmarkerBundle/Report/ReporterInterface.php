<?php

namespace BenchmarkerBundle\Report;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;

interface ReporterInterface
{
    /**
     * @param BenchmarkReportInterface $report
     *
     * @return bool
     */
    public function sendReport(BenchmarkReportInterface $report);

    /**
     * @return int|float
     */
    public function getTriggerRatio();

    /**
     * @param int|float $ratio
     *
     * @return $this
     */
    public function setTriggerRatio($ratio);
}

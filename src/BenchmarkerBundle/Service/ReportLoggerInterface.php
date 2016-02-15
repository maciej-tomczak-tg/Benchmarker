<?php

namespace BenchmarkerBundle\Service;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;

interface ReportLoggerInterface
{

    /**
     * @param BenchmarkReportInterface $report
     *
     * @return boolean
     */
    public function write(BenchmarkReportInterface $report);
}

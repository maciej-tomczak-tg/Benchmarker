<?php

namespace BenchmarkerBundle\Report;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;

interface ReportDispatcherInterface
{
    /**
     * @param BenchmarkReportInterface $benchmarkReport
     */
    public function dispatch(BenchmarkReportInterface $benchmarkReport);

    /**
     * @param ReporterInterface $reporter
     */
    public function registerReporter(ReporterInterface $reporter);
}

<?php

namespace BenchmarkerBundle\Report;


use BenchmarkerBundle\Entity\BenchmarkReportInterface;

class ReportDispatcher implements ReportDispatcherInterface
{
    /**
     * @var ReporterInterface[]
     */
    private $reporters = [];


    /**
     * Dispatch registered reporters if $report is Valid and ratio condition is met
     *
     * @param BenchmarkReportInterface $report
     */
    public function dispatch(BenchmarkReportInterface $report)
    {
        if (!$report->haveValidResults()) {
            return;
        }

        foreach ($this->reporters as $reporter) {
            if ($report->getFastestSiteToCompareRatio() > $reporter->getTriggerRatio()) {
                $reporter->sendReport($report);
            }
        }
    }

    /**
     * Register new reporter
     *
     * @param ReporterInterface $reporter
     */
    public function registerReporter(ReporterInterface $reporter)
    {
        $this->reporters[] = $reporter;
    }
}

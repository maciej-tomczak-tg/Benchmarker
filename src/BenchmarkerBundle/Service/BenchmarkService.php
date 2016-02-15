<?php

namespace BenchmarkerBundle\Service;

use BenchmarkerBundle\Entity\BenchmarkInterface;
use BenchmarkerBundle\Entity\BenchmarkReportInterface;

/**
 * Description of BenchmarkService
 *
 * @author morgan
 */
class BenchmarkService implements BenchmarkServiceInterface
{
    /**
     * @var LoadTimeServiceInterface
     */
    private $loadTimeService;

    public function __construct(LoadTimeServiceInterface $loadTimeService)
    {
        $this->loadTimeService = $loadTimeService;
    }

    /**
     * @param BenchmarkInterface $benchmark
     *
     * @return BenchmarkReportInterface
     */
    public function run(BenchmarkInterface $benchmark)
    {
        $this->loadTimeService->measureLoadTime($benchmark->getSiteToBenchmark());

        foreach ($benchmark->getSitesToCompare() as $site) {
            $this->loadTimeService->measureLoadTime($site);
        }

        $benchmark->setRunDate(new \DateTime());

        return $benchmark;
    }
}

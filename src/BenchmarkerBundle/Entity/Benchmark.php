<?php

namespace BenchmarkerBundle\Entity;

/**
 * Description of Benchmark
 *
 * @author morgan
 */
class Benchmark implements BenchmarkInterface, BenchmarkReportInterface
{
    const BENCHMARK_RAN = 'benchmark_ran';
    const BENCHMARK_NOT_RAN = 'benchmark_not_ran';

    /**
     * @var MeasurableInterface
     */
    private $site;

    /**
     * @var MeasurableInterface[]
     */
    private $sitesToCompare;

    /**
     * Date when test was performed
     *
     * @var \DateTime
     */
    private $runDate;

    /**
     * @param MeasurableInterface $site
     * @param MeasurableInterface[] $sitesToCompare
     */
    public function __construct(MeasurableInterface $site, array $sitesToCompare)
    {
        $this->site = $site;
        $this->sitesToCompare = $sitesToCompare;
        $this->status = self::BENCHMARK_NOT_RAN;
    }

    /**
     * @return MeasurableInterface
     */
    public function getSiteToBenchmark()
    {
        return $this->site;
    }

    /**
     * @return MeasurableInterface[]
     */
    public function getSitesToCompare()
    {
        return $this->sitesToCompare;
    }

    /**
     * @param MeasurableInterface $site
     *
     * @return $this
     */
    public function setSiteToBenchmark(MeasurableInterface $site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * @param MeasurableInterface[] $sitesToCompare
     *
     * @return $this
     */
    public function setSitesToCompare($sitesToCompare)
    {
        $this->sitesToCompare = $sitesToCompare;

        return $this;
    }

    /**
     * @return MeasurableInterface|null
     */
    public function getFastestSiteToCompare()
    {
        $sites = $this->getValidSitesToCompare();

        if (empty($sites)) {
            return null;
        }

        $fastest = reset($sites);
        foreach ($sites as $site) {
            if ($site->getLoadingTime() < $fastest->getLoadingTime()) {
                $fastest = $site;
            }
        }

        return $fastest;
    }

    /**
     * Method returns ratio of execution time of site to benchmark vs fastest site to compare
     *
     * @return float|null - ratio
     */
    public function getFastestSiteToCompareRatio()
    {
        if (!$this->haveValidResults()) {
            return null;
        }

        return $this->getSiteToBenchmark()->getLoadingTime() / $this->getFastestSiteToCompare()->getLoadingTime();
    }

    /**
     * @return MeasurableInterface[]
     */
    private function getValidSitesToCompare()
    {
        /** @var $sites MeasurableInterface[] */
        $sites = array_filter($this->getSitesToCompare(), function (MeasurableInterface $site) {
            return $site->isStatusSuccess();
        });

        return $sites;
    }

    /**
     * @return bool
     */
    public function haveValidResults()
    {
        $sites = $this->getValidSitesToCompare();

        return !empty($sites) &&  $this->getSiteToBenchmark()->isStatusSuccess() ? true: false;
    }

    /**
     * @return \DateTime
     */
    public function getRunDate()
    {
        return $this->runDate;
    }

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setRunDate(\DateTime $date)
    {
        $this->runDate = $date;

        return $this;
    }
}

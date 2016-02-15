<?php

namespace BenchmarkerBundle\Entity;

interface BenchmarkReportInterface
{

    /**
     * @return float
     */
    public function getFastestSiteToCompareRatio();

    /**
     * @return int
     */
    public function getFastestSiteToCompare();

    /**
     * @return \DateTime
     */
    public function getRunDate();

    /**
     * @return MeasurableInterface
     */
    public function getSiteToBenchmark();

    /**
     * @return MeasurableInterface[]
     */
    public function getSitesToCompare();

    /**
     * @return boolean
     */
    public function haveValidResults();
}

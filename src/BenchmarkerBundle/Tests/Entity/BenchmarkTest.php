<?php

namespace BenchmarkerBundle\Entity\Tests;

use BenchmarkerBundle\Entity\Benchmark;
use BenchmarkerBundle\Entity\Site;

/**
 * Class BenchmarkTest
 *
 * @package BenchmarkerBundle\Entity\Tests
 */
class BenchmarkTest extends \PHPUnit_Framework_TestCase
{
    public function haveResultsProvider()
    {
        // This is schema [site, sites1, sites2, isValid] structure.
        $prepareConf = [
            [true, true, false, true],
            [true, false, false, false],
            [true, true, true, true,],
            [false, false, true, false],
            [false, true, true, false],
            [false, false, false, false]
        ];
        $ret = [];
        foreach ($prepareConf as $conf) {

            $sites = [$this->getSite($conf[1]), $this->getSite($conf[2])];
            $ret[] = [new Benchmark($this->getSite($conf[0]), $sites), $conf[3]];
        }

        return $ret;
    }

    /**
     * @dataProvider haveResultsProvider
     *
     * @param Benchmark $benchmark
     * @param $isValid
     */
    public function testHaveValidResults(Benchmark $benchmark, $isValid)
    {
        $this->assertEquals($isValid, $benchmark->haveValidResults());
    }

    /**
     * @dataProvider fastestSiteProvider
     *
     * @param Benchmark $benchmark
     * @param Site $fastest
     */
    public function testGetFastestSiteToCompare(Benchmark $benchmark, Site $fastest)
    {
        $this->assertEquals($fastest->getLoadingTime(), $benchmark->getFastestSiteToCompare()->getLoadingTime());
    }

    /**
     * @dataProvider fastestSiteProvider
     *
     * @param Benchmark $benchmark
     * @param Site $fastest
     */
    public function testGetFastestSiteToCompareRatio(Benchmark $benchmark, Site $fastest)
    {
        // 1,5 = 300/200
        $this->assertEquals(1.5, $benchmark->getSiteToBenchmark()->getLoadingTime() / $fastest->getLoadingTime());
    }

    /**
     * @return array
     */
    public function fastestSiteProvider()
    {
        $site = $this->getSite(true, 300);
        $sites1 = $this->getSite(false, 100);
        $sites2 = $this->getSite(true, 200);
        $sites3 = $this->getSite(true, 300);
        $sites4 = $this->getSite(true, 400);

        $benchmark = new Benchmark($site, [$sites1, $sites2, $sites3, $sites4]);

        return [[$benchmark, $sites2]];
    }

    /**
     * @param $success
     * @param null $loadTime
     *
     * @return Site
     */
    private function getSite($success, $loadTime = null)
    {
        $site = new Site('http://whatever.conf');
        if ($success) {
            $site->setStatusSuccess();
        } else {
            $site->setStatusFailed();
        }

        if ($loadTime !== null) {
            $site->setLoadingTime($loadTime);
        }

        return $site;
    }
}

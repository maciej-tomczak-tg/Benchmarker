<?php
namespace BenchmarkerBundle\Factory;

use BenchmarkerBundle\Entity\Site;
use BenchmarkerBundle\Entity\Benchmark;
use BenchmarkerBundle\Entity\MeasurableInterface;

class BenchmarkFactory
{
    /**
     * @param MeasurableInterface $site
     * @param MeasurableInterface[] $sitesToCompare
     *
     * @return Benchmark
     */
    public function createBenchmark(MeasurableInterface $site, array $sitesToCompare)
    {
        return new Benchmark($site, $sitesToCompare);
    }

    /**
     * @param $url
     *
     * @return Site
     */
    public function createSite($url)
    {
        return new Site($url);
    }
}

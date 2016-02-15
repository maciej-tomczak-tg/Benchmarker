<?php

namespace BenchmarkerBundle\Service;

use BenchmarkerBundle\Entity\BenchmarkInterface;

interface BenchmarkServiceInterface
{

    /**
     * @param BenchmarkInterface $benchmark
     */
    public function run(BenchmarkInterface $benchmark);
}

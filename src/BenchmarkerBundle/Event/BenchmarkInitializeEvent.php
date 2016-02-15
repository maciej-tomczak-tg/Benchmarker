<?php

namespace BenchmarkerBundle\Event;


use BenchmarkerBundle\Entity\BenchmarkInterface;
use Symfony\Component\EventDispatcher\Event;

class BenchmarkInitializeEvent extends Event
{
    /**
     * @var BenchmarkInterface
     */
    private $benchmark;

    /**
     * @param BenchmarkInterface $benchmark
     */
    public function __construct(BenchmarkInterface $benchmark)
    {
        $this->benchmark = $benchmark;
    }

    /**
     * @return BenchmarkInterface
     */
    public function getBenchmark()
    {
        return $this->benchmark;
    }

}

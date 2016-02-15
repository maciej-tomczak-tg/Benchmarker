<?php

namespace BenchmarkerBundle\Service;


use BenchmarkerBundle\Entity\MeasurableInterface;

interface LoadTimeServiceInterface
{
    /**
     * @param MeasurableInterface $measurable
     *
     * @return MeasurableInterface
     */
    public function measureLoadTime(MeasurableInterface $measurable);
}

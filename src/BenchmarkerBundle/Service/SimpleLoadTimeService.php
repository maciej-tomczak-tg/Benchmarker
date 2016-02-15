<?php

namespace BenchmarkerBundle\Service;

use BenchmarkerBundle\Entity\MeasurableInterface;

class SimpleLoadTimeService implements LoadTimeServiceInterface
{

    /**
     * @param MeasurableInterface $measurable
     *
     * @return MeasurableInterface
     */
    public function measureLoadTime(MeasurableInterface $measurable)
    {
        $t1 = microtime(true);
        $results = @file_get_contents($measurable->getUrl());
        $t2 = microtime(true);
        $time = ($t2 - $t1) * 1000;
        if (is_string($results)) {
            $measurable->setLoadingTime($time);
            $measurable->setStatusSuccess();
        } else {
            $measurable->setStatusFailed();
        }

        return $measurable;
    }
}

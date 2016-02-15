<?php

namespace BenchmarkerBundle\Entity;

/**
 *
 * @author morgan
 */
interface BenchmarkInterface
{
    /**
     * @return MeasurableInterface
     */
    public function getSiteToBenchmark();
    
    /**
     * 
     * @param MeasurableInterface $site
     *
     * @return $this;
     */
    public function setSiteToBenchmark(MeasurableInterface $site);
    
    /**
     * 
     * @return MeasurableInterface[]
     */
    public function getSitesToCompare();
    
    /**
     *
     * @param MeasurableInterface[] $sitesToCompare
     *
     * @return $this
     */
    public function setSitesToCompare($sitesToCompare);

    /**
     * @param \DateTime $date
     *
     * @return $this
     */
    public function setRunDate(\DateTime $date);
}

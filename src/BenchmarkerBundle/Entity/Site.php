<?php

namespace BenchmarkerBundle\Entity;

/**
 * Description of Site
 *
 * @author morgan
 */
class Site implements MeasurableInterface
{
    const MEASURE_STATUS_SUCCESS = 'measure_status_success';
    const MEASURE_STATUS_FAILED = 'measure_status_failed';
    const MEASURE_STATUS_NOT_MEASURED = 'measure_status_not_measured';

    /**
     *
     * @var string url of site
     */
    private $url;

    /**
     * @var int
     */
    private $loadingTime;

    /**
     * @var string
     */
    private $measureStatus;

    /**
     * 
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->measureStatus = self::MEASURE_STATUS_NOT_MEASURED;
    }
    
    /**
     * 
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }


    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param int $loadingTime
     *
     * @return $this
     */
    public function setLoadingTime($loadingTime)
    {
        $this->loadingTime = $loadingTime;

        return $this;
    }

    /**
     * @return int - time in ms
     */
    public function getLoadingTime()
    {
        return $this->loadingTime;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getUrl();
    }


    /**
     * @return $this
     */
    public function setStatusSuccess()
    {
        $this->measureStatus = self::MEASURE_STATUS_SUCCESS;

        return $this;
    }

    /**
     * @return $this
     */
    public function setStatusFailed()
    {
        $this->measureStatus = self::MEASURE_STATUS_FAILED;

        return $this;
    }

    /**
     * @return bool
     */
    public function isStatusSuccess()
    {
        return $this->measureStatus === self::MEASURE_STATUS_SUCCESS;
    }

    /**
     * @return bool
     */
    public function isStatusFailed()
    {
        return $this->measureStatus === self::MEASURE_STATUS_FAILED;
    }
}

<?php
namespace BenchmarkerBundle\Entity;

interface MeasurableInterface
{
    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param $url
     *
     * @return $this
     */
    public function setUrl($url);

    /**
     * @param int $loadingTime
     *
     * @return $this
     */
    public function setLoadingTime($loadingTime);

    /**
     * @return int time in ms
     */
    public function getLoadingTime();

    /**
     * @return $this
     */
    public function setStatusSuccess();

    /**
     * @return $this
     */
    public function setStatusFailed();

    /**
     * @return boolean
     */
    public function isStatusSuccess();

    /**
     * @return boolean
     */
    public function isStatusFailed();

    /**
     * @return string
     */
    public function __toString();
}

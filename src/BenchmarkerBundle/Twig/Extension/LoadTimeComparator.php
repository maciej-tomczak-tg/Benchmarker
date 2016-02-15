<?php

namespace BenchmarkerBundle\Twig\Extension;

use BenchmarkerBundle\Entity\MeasurableInterface;

class LoadTimeComparator extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'load_time_comparator';
    }

    public function getFunctions()
    {
        return [
            'compare_time_percent' => new \Twig_SimpleFunction('compare_time_percent', [$this, 'compare_time_percent']),
            'site_loading_time'    => new \Twig_SimpleFunction('site_loading_time', [$this, 'site_loading_time'])
        ];
    }

    /**
     * This method returns percent of time needed to load $measure in comparison to $toCompare
     *
     * @param MeasurableInterface $measure
     * @param MeasurableInterface $toCompare
     * @param int $precision - precision of percent
     *
     * @return string
     */
    public function compare_time_percent(MeasurableInterface $measure, MeasurableInterface $toCompare, $precision = 2)
    {
        if ($measure->getLoadingTime() == 0 || $toCompare->getLoadingTime() == 0) {
            return 'n/a';
        }

        $percent = $toCompare->getLoadingTime() / $measure->getLoadingTime() * 100;
        return round($percent, $precision) . '%';
    }

    /**
     * @param MeasurableInterface $site
     * @param int $precision
     *
     * @return float|string
     */
    public function site_loading_time(MeasurableInterface $site, $precision = 3)
    {
        if ($site->isStatusFailed()) {
            return 'Sorry, can\'t test this one, test failed';
        }

        return round($site->getLoadingTime(), $precision) . ' ms';
    }
}

<?php

namespace BenchmarkerBundle\EventListener;


use BenchmarkerBundle\BenchmarkerEvents;
use BenchmarkerBundle\Event\BenchmarkCompletedEvent;
use BenchmarkerBundle\Report\ReportDispatcherInterface;
use BenchmarkerBundle\Service\ReportLoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BenchmarkerEventListener implements EventSubscriberInterface
{
    /**
     * @var ReportLoggerInterface
     */
    private $reportLogger;
    /**
     * @var ReportDispatcherInterface
     */
    private $reportDispatcher;


    /**
     * @param ReportLoggerInterface $reportLogger
     * @param ReportDispatcherInterface $reportDispatcher
     */
    public function __construct(ReportLoggerInterface $reportLogger, ReportDispatcherInterface $reportDispatcher)
    {
        $this->reportLogger = $reportLogger;
        $this->reportDispatcher = $reportDispatcher;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2')))
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            BenchmarkerEvents::RUN_BENCHMARK_COMPLETED => [
                ['logReport'],
                ['sendReports']
            ]
        ];
    }

    public function logReport(BenchmarkCompletedEvent $event)
    {
        $this->reportLogger->write($event->getBenchmarkReport());
    }

    public function sendReports(BenchmarkCompletedEvent $event)
    {
        $this->reportDispatcher->dispatch($event->getBenchmarkReport());
    }
}

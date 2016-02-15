<?php
namespace BenchmarkerBundle\Sms;

use BenchmarkerBundle\Entity\BenchmarkReportInterface;

class SiteIsSlowerSms implements SmsInterface
{
    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $body;
    /**
     * @var BenchmarkReportInterface
     */
    private $benchmark;


    /**
     * @param BenchmarkReportInterface $benchmark
     */
    public function __construct(BenchmarkReportInterface $benchmark)
    {
        $this->benchmark = $benchmark;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     *
     * @return $this
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if ($this->body === null) {
            $this->generateBody();
        }

        return $this->body;
    }

    /**
     * Generates sms content
     */
    private function generateBody()
    {
        $this->body = sprintf(
            'Website %s is loaded slower than at least one of the competitors',
            $this->benchmark->getSiteToBenchmark()
        );
    }
}

<?php
namespace BenchmarkerBundle\Email;

use BenchmarkerBundle\Entity\BenchmarkInterface;
use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;

class SiteIsSlowerEmail implements EmailInterface
{
    /**
     * @var BenchmarkInterface
     */
    private $benchmark;

    /**
     * @var string
     */
    private $emailReceiver;

    /**
     * @var string
     */
    private $body;
    /**
     * @var TwigEngine
     */
    private $renderer;
    /**
     * @var string
     */
    private $template;

    /**
     * @param BenchmarkReportInterface $benchmark
     * @param TwigEngine $templateRenderer
     * @param string $template - file with twig template
     * @param string $emailReceiver string email of recipient
     */
    public function __construct(
        BenchmarkReportInterface $benchmark,
        TwigEngine $templateRenderer,
        $template,
        $emailReceiver
    ) {
        $this->benchmark = $benchmark;
        $this->emailReceiver = $emailReceiver;
        $this->renderer = $templateRenderer;
        $this->template = $template;
    }

    public function getSubject()
    {
        return sprintf('Benchmark: Site %s is slow', $this->benchmark->getSiteToBenchmark()->getUrl());
    }

    public function getReceiver()
    {
        return $this->emailReceiver;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        if (empty($this->body)) {
            $this->body = $this->generateBody();
        }

        return $this->body;
    }

    /**
     * @return string
     *
     * @throws \Exception
     * @throws \Twig_Error
     */
    private function generateBody()
    {
        return $this->renderer->render($this->template, [
            'benchmark' => $this->benchmark
        ]);
    }
}

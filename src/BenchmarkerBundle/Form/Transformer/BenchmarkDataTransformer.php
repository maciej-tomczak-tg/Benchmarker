<?php
namespace BenchmarkerBundle\Form\Transformer;

use BenchmarkerBundle\Entity\Benchmark;
use Symfony\Component\Form\DataTransformerInterface;
use BenchmarkerBundle\Factory\BenchmarkFactory;

class BenchmarkDataTransformer implements DataTransformerInterface
{
    /**
     * @var BenchmarkFactory
     */
    private $benchmarkFactory;

    public function __construct(BenchmarkFactory $benchmarkFactory)
    {
        $this->benchmarkFactory = $benchmarkFactory;
    }

    /**
     * @param array $values
     *
     * @return Benchmark
     */
    public function reverseTransform($values)
    {
        $sitesToCompare = [];
        $sitesUrls = explode("\n", $values['compare_sites']);
        foreach ($sitesUrls as $url) {
            $sitesToCompare[] = $this->benchmarkFactory->createSite(trim($url));
        }
        
        $site = $this->benchmarkFactory->createSite(trim($values['site']));
        
        return $this->benchmarkFactory->createBenchmark($site, $sitesToCompare);
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function transform($value)
    {
        return $value;
    }
}

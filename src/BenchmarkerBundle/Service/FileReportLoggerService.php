<?php
namespace BenchmarkerBundle\Service;

use BenchmarkerBundle\Entity\BenchmarkReportInterface;
use BenchmarkerBundle\Entity\MeasurableInterface;
use Symfony\Component\Filesystem\Exception\IOException;

class FileReportLoggerService implements ReportLoggerInterface
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var resource
     */
    private $fileHandle;

    /**
     * @param string $fileName
     */
    public function __construct($fileName)
    {
        if (empty($fileName)) {
            throw new \InvalidArgumentException('You must provide file name to logger');
        }

        $this->fileName = $fileName;
    }

    /**
     * @param BenchmarkReportInterface $report
     *
     * @return bool
     */
    public function write(BenchmarkReportInterface $report)
    {
        $this->openFile();
        $log = $this->createLogFromReport($report);
        $this->writeToFile($log);
        $this->closeFile();
    }

    /**
     * Opens file to write
     */
    private function openFile()
    {
        $fh = @fopen($this->fileName, 'a');
        if ($fh === false) {
            throw new IOException(sprintf('Cant open file %s', $this->fileName));
        }

        $this->fileHandle = $fh;
    }

    /**
     * Closes file to write
     */
    private function closeFile()
    {
        fclose($this->fileHandle);
    }

    /**
     * Writes to file
     * @param $reportString
     */
    private function writeToFile($reportString)
    {
        if (fwrite($this->fileHandle, $reportString) === false) {
            throw new IOException(sprintf('Cant write to file %s', $this->fileName));
        }
    }

    /**
     * @param BenchmarkReportInterface $report
     *
     * @return string
     */
    private function createLogFromReport(BenchmarkReportInterface $report)
    {
        $logs = $this->getLogLine($report->getSiteToBenchmark());
        foreach ($report->getSitesToCompare() as $site) {
            $logs .= $this->getLogLine($site);
        }

        return $logs;
    }

    /**
     * Generate log string from single $site
     * @param MeasurableInterface $site
     *
     * @return string
     */
    public function getLogLine(MeasurableInterface $site)
    {
        if ($site->isStatusSuccess()) {
            return sprintf(
                "%s - Benchmarking site: %s - it took %d ms to load the site\n",
                date('Y-m-d H:i:s'),
                $site->getUrl(),
                $site->getLoadingTime()
            );

        } else {
            return sprintf(
                "%s - Benchmarking site: %s - benchmark failed\n",
                date('Y-m-d H:i:s'),
                $site->getUrl()
            );
        }
    }
}

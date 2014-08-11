<?php

namespace CL\DocData\Component\OrderApi\Type;

/**
 * @author Tijs Verkoyen <php-docdatapayments@verkoyen.eu>
 */
class StatusSuccess extends AbstractRequestSuccess
{
    /**
     * @var Report
     */
    protected $report;

    /**
     * @param Report $report
     */
    public function setReport($report)
    {
        $this->report = $report;
    }

    /**
     * @return Report
     */
    public function getReport()
    {
        return $this->report;
    }
}

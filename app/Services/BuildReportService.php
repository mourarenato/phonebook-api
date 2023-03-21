<?php

namespace App\Services;

use App\Jobs\BuildReportJob;

class BuildReportService
{
    public function dispatchBuildReportJob(): void
    {
        BuildReportJob::dispatch();
    }
}

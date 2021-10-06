<?php

namespace App\Jobs;

use App\Services\PostImportService;

class ProcessImportPostRequest extends AbstractJob
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $authorId;
    private $url;
    public function __construct(int $authorId, string $url)
    {
        $this->authorId = $authorId;
        $this->url = $url;
    }

    /**
     * @param PostImportService $service
     */
    public function handle(PostImportService $service)
    {
        //Call import post service
        $service->importPost($this->authorId, $this->url);
    }
}

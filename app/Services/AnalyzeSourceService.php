<?php

namespace App\Services;

use App\Models\Source;
use App\Jobs\WarnUsersAboutChanges;
use App\Exceptions\NoHistoryException;
use App\Exceptions\InvalidSourceException;

class AnalyzeSourceService extends BaseService
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'source_id' => 'required|integer|exists:sources,id',
        ];
    }

    /**
     * Analyze the data of the source.
     *
     * @param array $data
     * @return Source
     */
    public function execute(array $data)
    {
        $this->validate($data);

        $source = Source::findOrFail($data['source_id']);

        if (!$source->valid) {
            throw new InvalidSourceException();
        }

        $this->checkGithub($source);

        return $source;
    }

    /**
     * Analyze if a Github repository has changed.
     *
     * @param Source $source
     * @return void
     */
    private function checkGithub(Source $source)
    {
        $latestCheck = $source->checks()->latest()->first();
        $secondLastCheck = $source->checks()->orderBy('created_at', 'desc')->skip(1)->take(1)->first();

        if (!$latestCheck || !$secondLastCheck) {
            exit;
        }

        if ($latestCheck->watchers_level != $secondLastCheck->watchers_level) {
            $this->warn($source, 'watchers');
        }

        if ($latestCheck->stars_level != $secondLastCheck->stars_level) {
            $this->warn($source, 'stars');
        }

        if ($latestCheck->forks_level != $secondLastCheck->forks_level) {
            $this->warn($source, 'forks');
        }
    }

    /**
     * Triggers a job to warn users about a change in the source.
     *
     * @param Source $source
     * @param string $kind
     * @return void
     */
    private function warn(Source $source, string $kind)
    {
        WarnUsersAboutChanges::dispatch($source, $kind)->onQueue('low');
    }
};

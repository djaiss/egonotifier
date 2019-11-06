<?php

namespace App\Services;

use App\Models\Check;
use App\Models\Github;
use App\Models\Source;
use App\Helpers\LevelHelper;
use Github\Exception\RuntimeException;
use App\Exceptions\InvalidSourceException;

class FetchSourceInformationService extends BaseService
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
     * @return Check
     */
    public function execute(array $data): Check
    {
        $this->validate($data);

        $source = Source::findOrFail($data['source_id']);

        if (!$source->valid) {
            throw new InvalidSourceException();
        }

        $check = $this->checkGithub($source);

        return $check;
    }

    /**
     * Mark as source as being invalid.
     *
     * @param Source $source
     * @return void
     */
    private function markInvalid(Source $source)
    {
        $source->valid = false;
        $source->save();
        throw new InvalidSourceException();
    }

    /**
     * Check the Github source by grabbing the HTML and finding the key elements.
     *
     * @param Source $source
     * @return Check|void
     */
    private function checkGithub(Source $source): ?Check
    {
        try {
            $repository = (new Github($source))->fetch();
        } catch (RuntimeException $e) {
            $this->markInvalid($source);
        }

        $watchers = $repository['watchers'];
        $stars = $repository['stars'];
        $forks = $repository['forks'];

        $levelHelper = new LevelHelper();

        return Check::create([
            'source_id' => $source->id,
            'watchers' => $watchers,
            'watchers_level' => $levelHelper->checkLevel($watchers),
            'stars' => $stars,
            'stars_level' => $levelHelper->checkLevel($stars),
            'forks' => $forks,
            'forks_level' => $levelHelper->checkLevel($forks),
        ]);
    }
}

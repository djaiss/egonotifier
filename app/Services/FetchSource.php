<?php

namespace App\Services;

use App\Models\Check;
use App\Models\Source;
use PHPHtmlParser\Dom;
use App\Helpers\LevelHelper;
use Ixudra\Curl\Facades\Curl;
use App\Exceptions\InvalidSourceException;
use PHPHtmlParser\Exceptions\EmptyCollectionException;

class FetchSource extends BaseService
{
    /**
     * A list of possible headers for curl.
     *
     * @var array
     */
    private $headers = [
        'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0',
        'User-Agent:Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36',
    ];

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

        if ($source->type == 'github.com') {
            $this->checkGithub($source);
        }

        return $source;
    }

    /**
     * Choose a header from the list of headers.
     *
     * @return string
     */
    private function pickHeader() : string
    {
        return array_rand($this->headers);
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
     * @return Check
     */
    private function checkGithub(Source $source) : Check
    {
        $response = Curl::to($source->url)
            ->withHeader($this->pickHeader())
            ->returnResponseObject()
            ->get();

        if ($response->status != 200) {
            $this->markInvalid($source);
        }

        $dom = new Dom;
        $dom->load($response->content);

        // checking watchers, stars and forks
        try {
            $contents = $dom->find('#js-repo-pjax-container > div.pagehead.repohead.instapaper_ignore.readability-menu.experiment-repo-nav > div > ul > li:nth-child(2) > a.social-count');
        } catch (EmptyCollectionException $e) {
            $this->markInvalid($source);
        }
        $watchers = 0;
        $stars = 0;
        $forks = 0;
        $entry = 1;
        foreach ($contents as $content) {
            if ($entry == 1) {
                $watchers = (int) str_replace(',', '', $content->text);
            }

            if ($entry == 2) {
                $stars = (int) str_replace(',', '', $content->text);
            }

            if ($entry == 3) {
                $forks = (int) str_replace(',', '', $content->text);
            }

            $entry++;
        }

        // checking commits
        try {
            $commits = $dom->find('#js-repo-pjax-container > div.container-lg.clearfix.new-discussion-timeline.experiment-repo-nav.px-3 > div > div.overall-summary.overall-summary-bottomless > ul > li.commits > a > span')->text;
        } catch (EmptyCollectionException $e) {
            $this->markInvalid($source);
        }
        $commits = (int) str_replace(',', '', $commits);

        $levelHelper = new LevelHelper();

        return Check::create([
            'source_id' => $source->id,
            'watchers' => $watchers,
            'watchers_level' => $levelHelper->checkLevel($watchers),
            'stars' => $stars,
            'stars_level' => $levelHelper->checkLevel($stars),
            'forks' => $forks,
            'forks_level' => $levelHelper->checkLevel($forks),
            'commits' => $commits,
            'commits_level' => $levelHelper->checkLevel($commits),
        ]);
    }
}

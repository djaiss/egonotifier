<?php

namespace App\Services;

use App\Models\Source;
use League\Uri\Parser;

class AddSource extends BaseService
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'url' => 'required|string',
        ];
    }

    /**
     * Add a source.
     *
     * @param array $data
     * @return Source
     */
    public function execute(array $data) : Source
    {
        $this->validate($data);

        // get the host of the URL
        $parser = new Parser();
        $host = $parser->parse($data['url'])['host'];

        $source = Source::firstOrCreate([
            'url' => $data['url'],
            'type' => $host,
        ]);

        return $source;
    }
}

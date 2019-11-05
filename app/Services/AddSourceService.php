<?php

namespace App\Services;

use App\Models\Source;

class AddSourceService extends BaseService
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string',
            'repository' => 'required|string',
        ];
    }

    /**
     * Add a source.
     *
     * @param array $data
     * @return Source
     */
    public function execute(array $data): Source
    {
        $this->validate($data);

        $source = Source::firstOrCreate([
            'username' => $data['username'],
            'repository' => $data['repository'],
        ]);

        return $source;
    }
}

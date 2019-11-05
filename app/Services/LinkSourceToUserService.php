<?php

namespace App\Services;

use App\User;
use App\Models\Source;

class LinkSourceToUserService extends BaseService
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
            'user_id' => 'required|integer|exists:users,id',
        ];
    }

    /**
     * Link a source to a user.
     *
     * @param array $data
     * @return void
     */
    public function execute(array $data)
    {
        $this->validate($data);

        $user = User::find($data['user_id']);

        $user->sources()->syncWithoutDetaching($data['source_id']);
    }
}

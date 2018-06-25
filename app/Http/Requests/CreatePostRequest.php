<?php

namespace App\Http\Requests;

use App\Exceptions\ThrottleException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreatePostRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('create', new \App\Reply);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'body' => 'required|spamfree',
        ];
    }

    protected function failedAuthorization()
    {
        throw new ThrottleException('You are repling too frequently. Please take a break.');
    }

    public function persist($thread)
    {
        return $thread->addReply([
          'body'    => request('body'),
          'user_id' => auth()->id(),
        ])->load('owner');
    }
}

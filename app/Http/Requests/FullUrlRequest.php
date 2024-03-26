<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Services\ShortUrl\Input\InfoForShorted;

class FullUrlRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => ['required', 'url'],
            'expiry' => ['required', 'date'],
        ];
    }

    public function createDto(): InfoForShorted
    {
        return new InfoForShorted($this->get('url'), $this->get('expiry'));
    }
}

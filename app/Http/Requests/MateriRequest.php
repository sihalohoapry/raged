<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=> 'sometimes|string',
            'description'=> 'sometimes',
            'link_streaming'=> 'nullable|string',
            'cover_materi'=>'sometimes|image|mimes:png,jpg,jpeg|max:2048',
            'video'=> 'nullable|mimes:mp4,mp3|max:100000',
            'audio'=> 'nullable|mimetypes:audio/*|max:100000',
        ];
    }
}

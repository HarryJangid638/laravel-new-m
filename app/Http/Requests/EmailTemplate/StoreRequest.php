<?php
namespace App\Http\Requests\EmailTemplate;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:email_templates,slug',
            'subject' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email_keys' => 'nullable|string|max:255',
            'footer_text' => 'nullable|string|max:255',
            'email_preference_id' => 'nullable|integer|exists:email_preferences,id',
            'is_active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'slug.required' => 'The slug field is required.',
            'slug.unique' => 'The slug has already been taken.',
            'subject.required' => 'The subject field is required.',
            'description.required' => 'The description field is required.',
            'is_active.required' => 'The status field is required.',
            'is_active.boolean' => 'The status must be true or false.',
            'email_preference_id.exists' => 'The selected email preference is invalid.',
        ];
    }
}

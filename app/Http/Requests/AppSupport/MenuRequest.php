<?php

namespace App\Http\Requests\AppSupport;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'title_key' => ['nullable', 'string', 'max:100'],
            'url' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:100'],
            'paths' => ['nullable', 'integer', 'min:0', 'max:10'],
            'main_menu_id' => ['nullable', 'exists:menus,id'],
            'orders' => ['nullable', 'integer'],
            'active' => ['nullable', 'boolean'],
            'meta' => ['nullable', 'array'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['nullable', 'string'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['nullable', 'string'],
            'sub_menus' => ['nullable', 'array'],
            'sub_menus.*.name' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.title_en' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.title_key' => ['nullable', 'string', 'max:100'],
            'sub_menus.*.url' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.icon' => ['nullable', 'string', 'max:100'],
            'sub_menus.*.paths' => ['nullable', 'integer'],
            'sub_menus.*.orders' => ['nullable', 'integer'],
            'sub_menus.*.permissions' => ['nullable', 'array'],
            'sub_menus.*.sub_sub_menus' => ['nullable', 'array'],
            'sub_menus.*.sub_sub_menus.*.name' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.sub_sub_menus.*.title_en' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.sub_sub_menus.*.title_key' => ['nullable', 'string', 'max:100'],
            'sub_menus.*.sub_sub_menus.*.url' => ['nullable', 'string', 'max:255'],
            'sub_menus.*.sub_sub_menus.*.icon' => ['nullable', 'string', 'max:100'],
            'sub_menus.*.sub_sub_menus.*.paths' => ['nullable', 'integer'],
            'sub_menus.*.sub_sub_menus.*.orders' => ['nullable', 'integer'],
            'sub_menus.*.sub_sub_menus.*.permissions' => ['nullable', 'array'],
        ];
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        $mainMenuId = null;
        if ($this->filled('parent_level2_id') && $this->input('parent_level2_id') !== '') {
            $mainMenuId = (int) $this->input('parent_level2_id');
        } elseif ($this->filled('parent_level1_id') && $this->input('parent_level1_id') !== '') {
            $mainMenuId = (int) $this->input('parent_level1_id');
        } elseif ($this->filled('main_menu_id') && $this->input('main_menu_id') !== '') {
            $mainMenuId = (int) $this->input('main_menu_id');
        }

        $this->merge([
            'active' => $this->boolean('active'),
            'paths' => $this->filled('paths') ? (int) $this->input('paths') : null,
            'orders' => $this->filled('orders') ? (int) $this->input('orders') : 0,
            'main_menu_id' => $mainMenuId,
        ]);
    }
}

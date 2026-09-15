<?php

namespace App\Http\Requests\ManajemenPengguna;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user')->id ?? $this->route('user') : null;
        $isUpdate = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'password' => $isUpdate
                ? ['nullable', 'string', Password::defaults()]
                : ['required', 'string', Password::defaults()],
            'role' => ['required', 'string', 'exists:roles,name'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'Nama Pengguna',
            'email' => 'Alamat Email',
            'avatar' => 'Foto Profil',
            'password' => 'Kata Sandi',
            'role' => 'Peran Pengguna',
        ];
    }

    /**
     * Get custom error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama pengguna wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah terdaftar di sistem.',
            'avatar.image' => 'Berkas foto profil harus berupa gambar.',
            'avatar.mimes' => 'Format foto profil yang didukung: JPEG, PNG, JPG, GIF, SVG, WEBP.',
            'avatar.max' => 'Ukuran berkas foto profil maksimal 2MB.',
            'password.required' => 'Kata sandi wajib diisi untuk pengguna baru.',
            'password.min' => 'Kata sandi minimal berisi :min karakter.',
            'role.required' => 'Pilih peran pengguna terlebih dahulu.',
            'role.exists' => 'Peran yang dipilih tidak ditemukan dalam sistem.',
        ];
    }
}

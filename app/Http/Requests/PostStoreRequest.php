<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        // Izinkan semua pengguna yang terautentikasi untuk membuat postingan.
        return true;
    }

    /**
     * Dapatkan aturan validasi yang berlaku untuk permintaan.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts|min:4|max:255',
            'category_id' => 'required',
            'body' => 'required|min:50',
            'image' => 'image|file|max:2048',
        ];
    }

    /**
     * Dapatkan nama atribut yang ditentukan untuk menggantikan nama jalur/key atribut.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'Judul',
            'category_id' => 'Kategori',
            'body' => 'Isi Konten',
            'image' => 'Gambar',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan untuk membuat permintaan ini.
     */
    public function authorize(): bool
    {
        // Izinkan semua pengguna yang terautentikasi untuk memperbarui postingan mereka.
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
            // Tambahkan ID postingan ke aturan unique agar postingan itu sendiri dikecualikan.
            'title' => 'required|min:4|max:255|unique:posts,title,' . $this->post->id,
            'category_id' => 'required',
            'body' => 'required',
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

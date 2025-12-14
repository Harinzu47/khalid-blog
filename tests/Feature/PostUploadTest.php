<?php

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('post image cannot exceed 2mb', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = Category::factory()->create();

    // Create a fake image of 3000 kilobytes (approx 3MB)
    $file = UploadedFile::fake()->image('large_image.jpg')->size(3000);

    $response = $this->actingAs($user)
        ->post('/dashboard', [
            'title' => 'Test Large Image',
            'category_id' => $category->id,
            'body' => 'This is a test body content that is long enough to pass validation rules.',
            'image' => $file,
        ]);

    // Should fail validation
    $response->assertSessionHasErrors(['image']);
});

test('post image under 2mb is accepted', function () {
    Storage::fake('public');
    $user = User::factory()->create();
    $category = Category::factory()->create();

    // Create a fake image of 1000 kilobytes (1MB)
    $file = UploadedFile::fake()->image('small_image.jpg')->size(1000);

    $response = $this->actingAs($user)
        ->post('/dashboard', [
            'title' => 'Test Small Image',
            'category_id' => $category->id,
            'body' => 'This is a test body content that is long enough to pass validation rules.',
            'image' => $file,
        ]);

    // Should NOT fail validation on image
    $response->assertSessionHasNoErrors();
});

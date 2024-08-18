<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{News};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class NewsControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.news.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.news.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.news.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.news.create');
    }

    public function test_store_news_with_valid_data()
    {
        // Arrange
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $requestData = [
            'title' => 'Test News Title',
            'slug' => 'test-news-title',
            'short_description' => 'This is a short description of the news.',
            'description' => 'This is a full description of the news.',
            'sort' => 1,
            'status' => 1,
            'thumbnail_alt' => 'Thumbnail alt text',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'image_mobile' => UploadedFile::fake()->image('image-mobile.jpg'),
            'tag' => 'test-tag',
            'meta_tag_title' => 'Test Meta Title',
            'meta_tag_keywords' => 'news,test',
            'meta_tag_description' => 'Test Meta Description',
        ];

        // Act
        $response = $this->post(route('admin.news.store'), $requestData);

        // Assert
        $response->assertRedirect(route('admin.news.index'));
        $response->assertSessionHas('success', 'News created successfully.');

        // Check the database
        $this->assertDatabaseHas('news', [
            'title' => 'Test News Title',
            'slug' => 'test-news-title',
            'short_description' => 'This is a short description of the news.',
            'description' => 'This is a full description of the news.',
            'sort' => 1,
            'status' => 1,
            'thumbnail_alt' => 'Thumbnail alt text',
            'meta_tag_title' => 'Test Meta Title',
            'meta_tag_keywords' => 'news,test',
            'meta_tag_description' => 'Test Meta Description',
        ]);

    }

    public function test_edit_news_view_is_rendered_correctly()
    {
        // Create a dummy news item
        $news = News::factory()->create();

        // Act as an admin or user with the necessary permissions
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the edit route
        $response = $this->get(route('admin.news.edit', $news->id));

        // Assert the response status is OK (200)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.news.edit');

        // Assert that the view receives the correct data
        $response->assertViewHas('news', $news);
    }


    public function test_update_news_with_valid_data()
    {
        // Arrange
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $news = News::factory()->create([
            'title' => 'Old News Title',
            'slug' => 'old-news-title',
            'short_description' => 'Old short description.',
            'description' => 'Old description.',
            'sort' => 1,
            'status' => 1,
            'thumbnail_alt' => 'Old Thumbnail Alt',
        ]);

        $requestData = [
            'title' => 'Updated News Title',
            'slug' => 'updated-news-title',
            'short_description' => 'Updated short description.',
            'description' => 'Updated description.',
            'sort' => 2,
            'status' => 1,
            'thumbnail_alt' => 'Updated Thumbnail Alt',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'image_mobile' => UploadedFile::fake()->image('image-mobile.jpg'),
            'tag' => 'updated-tag',
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_keywords' => 'updated,news',
            'meta_tag_description' => 'Updated Meta Description',
        ];

        // Act
        $response = $this->post(route('admin.news.update', $news), $requestData);

        // Assert
        $response->assertRedirect(route('admin.news.index'));
        $response->assertSessionHas('success', 'News updated successfully.');

        // Check the database
        $this->assertDatabaseHas('news', [
            'id' => $news->id,
            'title' => 'Updated News Title',
            'slug' => 'updated-news-title',
            'short_description' => 'Updated short description.',
            'description' => 'Updated description.',
            'sort' => 2,
            'status' => 1,
            'thumbnail_alt' => 'Updated Thumbnail Alt',
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_keywords' => 'updated,news',
            'meta_tag_description' => 'Updated Meta Description',
        ]);

    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a news record with status = 1
        $data = News::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.news.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'News status updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('news', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.news.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('news', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a News record
        $data = News::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.news.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'News deleted successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('news', [
            'id' => $data->id,
        ]);
    }


}

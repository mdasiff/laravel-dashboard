<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{MarketplaceCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class MarketplaceCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.marketplace-category.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.marketplace-category.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.marketplace-category.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.marketplace-category.create');
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create fake data for the request
        Storage::fake('public');

        $response = $this->post(route('admin.marketplace-category.store'), [
            'name' => 'Test Category with Image',
            'slug' => 'test-category-with-image',
            'sort' => 1,
            'status' => 1,
            'description' => 'This is a test description with image',
            'meta_tag_title' => 'Test Meta Title with Image',
            'meta_tag_description' => 'Test Meta Description with Image',
            'meta_tag_keywords' => 'test, keywords, image',
            'image' => UploadedFile::fake()->image('test-image.jpg')
        ]);

        $response->assertRedirect(route('admin.marketplace-category.index'));
        $response->assertSessionHas('success', 'Marketplace Category created successfully');

        $this->assertDatabaseHas('marketplace_categories', [
            'name' => 'Test Category with Image',
            'slug' => 'test-category-with-image',
            'sort' => 1,
            'status' => 1,
            'description' => 'This is a test description with image',
            'meta_tag_title' => 'Test Meta Title with Image',
            'meta_tag_description' => 'Test Meta Description with Image',
            'meta_tag_keywords' => 'test, keywords, image'
        ]);
    }

    public function test_edit_view()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample marketplace category
        $category = MarketplaceCategory::factory()->create([
            'name' => 'Sample Category',
            'slug' => 'sample-category'
        ]);

        // Perform a GET request to the edit route
        $response = $this->get(route('admin.marketplace-category.edit', $category));

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the view is the correct one and contains the expected data
        $response->assertViewIs('admin.marketplace-category.edit');
        $response->assertViewHas('sc', $category);
    }

    public function test_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $category = MarketplaceCategory::factory()->create([
            'name' => 'Old Category Name',
            'slug' => 'old-category-name'
        ]);

        $response = $this->post(route('admin.marketplace-category.update', $category), [
            'name' => 'Updated Category Name with Image',
            'sort' => 1,
            'status' => 1,
            'description' => 'Updated description with image',
            'meta_tag_title' => 'Updated Meta Tag Title with Image',
            'meta_tag_description' => 'Updated Meta Tag Description with Image',
            'meta_tag_keywords' => 'updated, meta, keywords, image',
            'image' => UploadedFile::fake()->image('updated-image.jpg')
        ]);

        $response->assertRedirect(route('admin.marketplace-category.index'));
        $response->assertSessionHas('success', 'Marketplace Category updated successfully');

        $this->assertDatabaseHas('marketplace_categories', [
            'id' => $category->id,
            'name' => 'Updated Category Name with Image',
            'slug' => 'updated-category-name-with-image',
            'sort' => 1,
            'status' => 1,
            'description' => 'Updated description with image',
            'meta_tag_title' => 'Updated Meta Tag Title with Image',
            'meta_tag_description' => 'Updated Meta Tag Description with Image',
            'meta_tag_keywords' => 'updated, meta, keywords, image'
        ]);
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a marketplace_categories record with status = 1
        $data = MarketplaceCategory::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.marketplace-category.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Marketplace Category updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('marketplace_categories', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.marketplace-category.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('marketplace_categories', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a MarketplaceCategory record
        $data = MarketplaceCategory::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.marketplace-category.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Marketplace Category deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('marketplace_categories', [
            'id' => $data->id,
        ]);
    }

}

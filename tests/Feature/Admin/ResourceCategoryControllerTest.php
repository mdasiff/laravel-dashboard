<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Resource, ResourceCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class ResourceCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some resource categories
        $categories = ResourceCategory::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.resource-category.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource-category.index');
        $response->assertViewHas('resource_categories');
        
        // Check if the resource categories are in the view
        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }
    public function test_create()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Act: Make a request to the create page
        $response = $this->get(route('admin.resource-category.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource-category.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $data = [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'A test description',
            'meta_tag_title' => 'Test Meta Title',
            'meta_tag_description' => 'Test Meta Description',
            'meta_tag_keywords' => 'Test, Meta, Keywords',
            'image' => UploadedFile::fake()->image('test-image.jpg'),
        ];

        $response = $this->post(route('admin.resource-category.store'), $data);

        $this->assertDatabaseHas('resource_categories', [
            'name' => 'Test Category',
            'slug' => 'test-category',
        ]);


        $response->assertRedirect(route('admin.resource-category.index'))
                 ->assertSessionHas('success', 'Resource Category created successfully');
    }

    public function test_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a resource category
        $resourceCategory = ResourceCategory::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-name',
        ]);

        // Fake the storage
        Storage::fake('public');

        // Simulate file upload
        $image = UploadedFile::fake()->image('category.jpg');

        // Prepare new data including the image
        $newData = [
            'name' => 'New Name',
            'sort' => 1,
            'status' => 1,
            'description' => 'Updated description',
            'meta_tag_title' => 'Updated meta title',
            'meta_tag_description' => 'Updated meta description',
            'meta_tag_keywords' => 'keyword1, keyword2',
            'image' => $image,
        ];

        // Simulate the form request
        $response = $this->post(route('admin.resource-category.update', $resourceCategory->id), $newData);

        // Assert the resource category was updated
        $this->assertDatabaseHas('resource_categories', [
            'id' => $resourceCategory->id,
            'name' => 'New Name',
            'slug' => 'new-name',
        ]);

        // Assert the response
        $response->assertRedirect(route('admin.resource-category.index'));
        $response->assertSessionHas('success', 'Resource Category updated successfully');
    }

    public function test_edit_resource_category()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a resource category using the factory
        $resourceCategory = ResourceCategory::factory()->create([
            'name' => 'Test Resource Category',
        ]);

        // Perform the GET request to the edit method
        $response = $this->get(route('admin.resource-category.edit', $resourceCategory->id));
        // dd($response);
        // Assert the view is rendered successfully
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource-category.edit');
        
        // Assert the resource category data is passed to the view
        $response->assertViewHas('rc', function($viewResourceCategory) use ($resourceCategory) {
            return $viewResourceCategory->id === $resourceCategory->id && $viewResourceCategory->name === $resourceCategory->name;
        });
    }


    public function test_status_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a product record with status = 1
        $data = ResourceCategory::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.resource-category.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Resource Category updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('resource_categories', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.resource-category.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('resource_categories', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }



    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ResourceCategory record
        $data = ResourceCategory::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.resource-category.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Resource Category deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('resources', [
            'id' => $data->id,
        ]);
    }

    
}

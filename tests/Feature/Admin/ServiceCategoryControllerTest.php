<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{ServiceCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class ServiceCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some ServiceCategory data
        $data = ServiceCategory::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.service-category.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.service-category.index');
        $response->assertViewHas('service_categories');
        
        // Check if the service-category data are in the view
        foreach ($data as $val) {
            $response->assertSee($val->name);
        }
    }
    public function test_create()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Act: Make a request to the create page
        $response = $this->get(route('admin.service-category.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.service-category.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

       // Arrange: Prepare the data and mock the image upload
        Storage::fake('public');
        $file = UploadedFile::fake()->image('image.jpg');
        $data = [
            'name' => 'Test Service Category',
            'slug' => 'test-service-category',
            'description' => 'A description for the service category.',
            'meta_tag_title' => 'Meta Title',
            'meta_tag_description' => 'Meta Description',
            'meta_tag_keywords' => 'meta, keywords',
            'status' => 1,
            'sort' => 1,
            'image' => $file,
        ];

        // Act: Make a POST request to the store route with the data
        $response = $this->post(route('admin.service-category.store'), $data);

        // Assert: Check that the service category was created and redirected correctly
        $response->assertRedirect(route('admin.service-category.index'))
                 ->assertSessionHas('success', 'Resource Category created successfully');

        $this->assertDatabaseHas('service_categories', [
            'name' => 'Test Service Category',
            'slug' => 'test-service-category',
            'description' => 'A description for the service category.',
            'meta_tag_title' => 'Meta Title',
            'meta_tag_description' => 'Meta Description',
            'meta_tag_keywords' => 'meta, keywords',
            'status' => 1,
            'sort' => 1,
        ]);

    } 

    public function test_edit()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create a service category to be edited
        $serviceCategory = ServiceCategory::factory()->create();

        // Act: Make a GET request to the edit route
        $response = $this->get(route('admin.service-category.edit', $serviceCategory));

        // Assert: Check that the response is successful and the correct view is returned
        $response->assertStatus(200)
                 ->assertViewIs('admin.service-category.edit')
                 ->assertViewHas('sc', $serviceCategory);

    }

    public function test_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');


        // Arrange: Prepare the initial data and mock the image upload
        Storage::fake('public');
        $existingCategory = ServiceCategory::factory()->create([
            'name' => 'Original Service Category',
            'slug' => 'original-service-category',
        ]);
        
        $file = UploadedFile::fake()->image('updated-image.jpg');
        $data = [
            'name' => 'Updated Service Category',
            'description' => 'Updated description.',
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
            'status' => 0,
            'sort' => 2,
            'image' => $file,
        ];

        // Act: Make a PUT request to the update route with the data
        $response = $this->post(route('admin.service-category.update', $existingCategory->id), $data);

        // Assert: Check that the service category was updated and redirected correctly
        $response->assertRedirect(route('admin.service-category.index'))
                 ->assertSessionHas('success', 'Service Category updated successfully');

        $this->assertDatabaseHas('service_categories', [
            'id' => $existingCategory->id,
            'name' => 'Updated Service Category',
            'slug' => 'updated-service-category',
            'description' => 'Updated description.',
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
            'status' => 0,
            'sort' => 2,
        ]);

    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a service-category record with status = 1
        $data = ServiceCategory::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.service-category.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Service Category updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('service_categories', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.service-category.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('service_categories', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ServiceCategory record
        $data = ServiceCategory::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.service-category.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Service Category deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('service_categories', [
            'id' => $data->id,
        ]);
    }
    
}

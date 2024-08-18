<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{ServiceCategory, Service};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class ServiceControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some Service data
        $data = Service::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.service.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.service.index');
        $response->assertViewHas('services');
        
        // Check if the service data are in the view
        foreach ($data as $val) {
            $response->assertSee($val->name);
        }
    }
    public function test_create()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Act: Make a request to the create page
        $response = $this->get(route('admin.service.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.service.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Prepare test data
        $category = ServiceCategory::factory()->create();
        $file = UploadedFile::fake()->image('image.jpg');
        $data = [
            'name' => 'Test Service',
            'category' => $category->id,
            'description' => 'Test Description',
            'status' => 1,
            'image' => $file,
        ];

        // Act: Make a POST request to store the service
        $response = $this->post(route('admin.service.store'), $data);

        // Assert: Check if the response redirects and the service is stored in the database
        $response->assertRedirect(route('admin.service.index'));
        $response->assertSessionHas('success', 'Service created successfully');
        $this->assertDatabaseHas('services', [
            'name' => 'Test Service',
            'description' => 'Test Description',
            'status' => 1,
        ]);

    }

    public function test_edit_service()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a service category and service using the factory
        $category = ServiceCategory::factory()->create();
        $service = Service::factory()->create([
            'service_category_id' => $category->id,
            'name' => 'Test Service',
        ]);

        // Perform the GET request to the edit method
        $response = $this->get(route('admin.service.edit', $service->id));

        // Assert the view is rendered
        $response->assertStatus(200);
        $response->assertViewIs('admin.service.edit');
        
        // Assert the service data is passed to the view
        $response->assertViewHas('sc', function($viewService) use ($service) {
            return $viewService->id === $service->id && $viewService->name === $service->name;
        });

        // Assert the categories data is passed to the view
        $response->assertViewHas('categories', function($viewCategories) use ($category) {
            return $viewCategories->contains('id', $category->id);
        });
    }

    public function test_update_service()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a service category and service using the factory
        $category = ServiceCategory::factory()->create();
        $service = Service::factory()->create([
            'service_category_id' => $category->id,
            'name' => 'Initial Service Name',
            'description' => 'Initial description',
            'status' => 1,
        ]);

        // Mock the file upload methods to avoid actual file operations
        Storage::fake('public');

        // Prepare the updated data
        $updatedData = [
            'category' => $category->id,
            'name' => 'Updated Service Name',
            'description' => 'Updated description',
            'status' => 0,
            'image' => UploadedFile::fake()->image('service.jpg'),
            'file' => UploadedFile::fake()->create('document.pdf', 1024),
        ];

        // Perform the PUT request to update the service
        $response = $this->post(route('admin.service.update', $service->id), $updatedData);

        // Check if the service was updated in the database
        $this->assertDatabaseHas('services', [
            'id' => $service->id,
            'name' => 'Updated Service Name',
            'description' => 'Updated description',
            'status' => 0,
        ]);

        // Check if the response redirects to the services index page
        $response->assertRedirect(route('admin.service.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Service updated successfully');
    }



    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a service record with status = 1
        $data = Service::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.service.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Service updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('services', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.service.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('services', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Service record
        $data = Service::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.service.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Service deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('services', [
            'id' => $data->id,
        ]);
    }
    
}

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

class ResourceControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some resource data
        $data = Resource::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.resource.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource.index');
        $response->assertViewHas('resources');
        
        // Check if the resource data are in the view
        foreach ($data as $val) {
            $response->assertSee($val->name);
        }
    }
    public function test_create()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Act: Make a request to the create page
        $response = $this->get(route('admin.resource.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create a ResourceCategory and prepare data
        $category = ResourceCategory::factory()->create();

        $data = [
            'category' => 1,
            'name' => 'Test Resource',
            'description' => 'This is a test resource description.',
            'image_alt' => 'Test image alt text',
            'home_image_alt' => 'Test home image alt text',
            'status' => 1,
            'show_on_home_page' => 1,
            'image' => UploadedFile::fake()->image('test_image.jpg'),
            'image_mobile' => UploadedFile::fake()->image('test_mobile_image.jpg'),
            'file' => UploadedFile::fake()->create('test_file.pdf', 1000),
        ];

        // Act: Post the data to the store route
        $response = $this->post(route('admin.resource.store'), $data);
        // dd($response);
        // Assert: Check that the resource was stored and the response is correct
        $response->assertRedirect(route('admin.resource.index'));
        $response->assertSessionHas('success', 'Resource created successfully');
        $this->assertDatabaseHas('resources', [
            'resource_category_id' => 1,
            'home_image_alt' => 'Test home image alt text',
            'name' => 'Test Resource',
            'description' => 'This is a test resource description.',
            'status' => 1,
            'show_on_home_page' => 1,
        ]);

        $resource = Resource::first();
        $this->assertNotNull($resource->image);
        $this->assertNotNull($resource->home_image);
        $this->assertNotNull($resource->file);
        
    }

    public function test_edit()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create a ResourceCategory and a Resource
        $category = ResourceCategory::factory()->create();
        $resource = Resource::factory()->create([
            'resource_category_id' => $category->id,
        ]);

        // Act: Access the edit route for the resource
        $response = $this->get(route('admin.resource.edit', $resource));

        // Assert: Check that the response is successful and contains the expected data
        $response->assertStatus(200);
        $response->assertViewIs('admin.resource.edit');
        $response->assertViewHas('rc', $resource);
        $response->assertViewHas('categories', ResourceCategory::all());

    }

    public function test_update_resource()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create an existing resource
        $resource = Resource::factory()->create([
            'name' => 'Initial Resource Name',
            'description' => 'Initial description.',
            'status' => 1,
            'show_on_home_page' => 0,
        ]);

        // Mock the file upload methods to avoid actual file operations
        Storage::fake('public');

        // Prepare the updated data
        $updatedData = [
            'category' => 1,
            'name' => 'Updated Resource Name',
            'description' => 'Updated description.',
            'status' => 1,
            'show_on_home_page' => 1,
            'image' => UploadedFile::fake()->image('resource.jpg'),
            'file' => UploadedFile::fake()->create('document.pdf', 1024),
            'image_mobile' => UploadedFile::fake()->image('mobile_image.jpg'),
        ];

        // Perform the PUT request to update the resource
        $response = $this->post(route('admin.resource.update', $resource->id), $updatedData);

        // Check if the resource was updated in the database
        $this->assertDatabaseHas('resources', [
            'id' => $resource->id,
            'name' => 'Updated Resource Name',
            'description' => 'Updated description.',
            'status' => 1,
            'show_on_home_page' => 1,
        ]);


        // Check if the response redirects to the resources index page
        $response->assertRedirect(route('admin.resource.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Resource updated successfully');
    }


    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a resource record with status = 1
        $data = Resource::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.resource.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Resource updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('resources', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.resource.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('resources', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a resource record
        $data = Resource::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.resource.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Resource deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('resources', [
            'id' => $data->id,
        ]);
    }
    
}

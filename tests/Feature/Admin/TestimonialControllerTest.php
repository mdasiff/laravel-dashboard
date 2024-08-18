<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Testimonial};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class TestimonialControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some tesimonial data
        $data = Testimonial::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.testimonials.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.testimonial.index');
        $response->assertViewHas('testimonials');
        
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
        $response = $this->get(route('admin.testimonials.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.testimonial.create');
        
    }

    public function test_store()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Fake the file system
        Storage::fake('public');

        // Define the file to upload
        $file = UploadedFile::fake()->image('testimonial.jpg');

        // Prepare the request data
        $data = [
            'name' => 'Testimonial Name',
            'location' => 'Test Location',
            'message' => 'Test Message',
            'sort' => 1,
            'status' => 1,
            'image' => $file,
            'type' => 'text',
        ];

        // Post request to store the testimonial
        $response = $this->post(route('admin.testimonials.store'), $data);

        // Assert the response and database changes
        $response->assertRedirect(route('admin.testimonials.index'));
        $response->assertSessionHas('success', 'Testimonial created successfully.');

        // Assert the testimonial was stored in the database
        $this->assertDatabaseHas('testimonials', [
            'name' => 'Testimonial Name',
            'location' => 'Test Location',
            'message' => 'Test Message',
            'sort' => 1,
            'status' => 1,
            'type' => 'text',
        ]);

    }

    public function test_edit()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Testimonial instance using factory
        $testimonial = Testimonial::factory()->create();

        // Send a GET request to the edit route
        $response = $this->get(route('admin.testimonials.edit', $testimonial->id));

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the view is the correct one
        $response->assertViewIs('admin.testimonial.update');

        // Assert the view has the expected data
        $response->assertViewHas('testimonial', $testimonial);
    }

    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        // Create a tesimonial and a category
        $tesimonial = Testimonial::factory()->create();
    

        // Mock file upload
        Storage::fake('public');
        $image = UploadedFile::fake()->image('image.jpg');

        $data = [
            'name' => 'Md Asif',
            'video' => 'youtube',
            'type' => 'text',
            'location' => 'Delhi',
            'image_alt' => 'Image alt val',
            'message' => 'this is message',
            'sort' => 1,
            'status' => 1,
            'show_on_home_page' => 1,
            'image'=>$image
        ];

        // Act
        $response = $this->post(route('admin.testimonials.update', $tesimonial->id), $data);
        // Assert
        $response->assertRedirect(route('admin.testimonials.index'));
        $response->assertSessionHas('success', 'Testimonial updated successfully.');

        $tesimonial->refresh();

        // Check if the tesimonial was updated in the database
        $this->assertEquals($data['name'], $tesimonial->name);
        $this->assertEquals($data['video'], $tesimonial->video);
        $this->assertEquals($data['type'], $tesimonial->type);
        $this->assertEquals($data['location'], $tesimonial->location);

    }
    
    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Testimonial record with status = 1
        $data = Testimonial::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.testimonials.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Testimonial status updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('testimonials', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.testimonials.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('testimonials', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Testimonial record
        $data = Testimonial::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.testimonials.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Testimonial deleted successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('testimonials', [
            'id' => $data->id,
        ]);
    }
}

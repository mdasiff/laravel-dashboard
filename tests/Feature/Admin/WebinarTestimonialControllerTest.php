<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{WebinarTestimonial};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class WebinarTestimonialControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some tesimonial data
        $data = WebinarTestimonial::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.webinar_testimoni.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar_testimonial.index');
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
        $response = $this->get(route('admin.webinar_testimoni.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar_testimonial.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Prepare the data for the POST request
        $data = [
            'location' => 'Online',
            'message' => 'This is a test message.',
            'sort' => 1,
            'status' => 1,
            'image_alt' => 'Test Image Alt',
            'name' => 'Test Testimonial',
        ];

        // Optionally include an image file in the request
        $image = UploadedFile::fake()->image('test-image.jpg');
        $data['image'] = $image;

        // Perform the POST request to store the testimonial
        $response = $this->post(route('admin.webinar_testimoni.store'), $data);

        // Check if the new testimonial was created in the database
        $this->assertDatabaseHas('webinar_testimonials', [
            'location' => 'Online',
            'message' => 'This is a test message.',
            'sort' => 1,
            'status' => 1,
            'name' => 'Test Testimonial',
        ]);

        // Check if the response redirects to the testimonial index page
        $response->assertRedirect(route('admin.webinar_testimoni.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Testimonial created successfully.');

    }

    public function test_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create an initial testimonial using the factory
        $testimonial = WebinarTestimonial::factory()->create([
            'name' => 'Old Testimonial Name',
            'location' => 'Old Location',
            'message' => 'Old message content.',
            'sort' => 1,
            'status' => 0,
        ]);

        // Prepare the updated data
        $updatedData = [
            'name' => 'Updated Testimonial Name',
            'location' => 'Updated Location',
            'message' => 'Updated message content.',
            'sort' => 2,
            'status' => 1,
            'image_alt' => 'Updated Image Alt',
            'video' => 'https://example.com/updated-video', // This should be omitted as type is 'text'
        ];

        // Optionally include an image file in the request
        $image = UploadedFile::fake()->image('updated-image.jpg');
        $updatedData['image'] = $image;

        // Perform the PUT request to update the testimonial
        $response = $this->post(route('admin.webinar_testimoni.update', $testimonial->id), $updatedData);
        // dd($response);
        // Check if the testimonial was updated in the database
        $this->assertDatabaseHas('webinar_testimonials', [
            'id' => $testimonial->id,
            'name' => 'Updated Testimonial Name',
            'location' => 'Updated Location',
            'message' => 'Updated message content.',
            'sort' => 2,
            'status' => 1,
            'image_alt' => 'Updated Image Alt',
        ]);

        // Check if the response redirects to the testimonial index page
        $response->assertRedirect(route('admin.webinar_testimoni.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Testimonial updated successfully.');

    }


    public function test_edit_webinar_testimonial()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a webinar testimonial using the factory
        $testimonial = WebinarTestimonial::factory()->create([
            'name' => 'Test Testimonial',
            'message' => 'This is a test message.',
        ]);

        // Perform the GET request to the edit method
        $response = $this->get(route('admin.webinar_testimoni.edit', $testimonial->id));

        // Assert the view is rendered successfully
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar_testimonial.update');
        
        // Assert the testimonial data is passed to the view
        $response->assertViewHas('testimonial', function($viewTestimonial) use ($testimonial) {
            return $viewTestimonial->id === $testimonial->id && $viewTestimonial->name === $testimonial->name;
        });
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a WebinarTestimonial record with status = 1
        $data = WebinarTestimonial::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.webinar_testimoni.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Testimonial status updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('webinar_testimonials', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.webinar_testimoni.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('webinar_testimonials', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a WebinarTestimonial record
        $data = WebinarTestimonial::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.webinar_testimoni.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Testimonial deleted successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('webinar_testimonials', [
            'id' => $data->id,
        ]);
    }
}

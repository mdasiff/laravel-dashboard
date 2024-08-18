<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Webinar, Speaker, Timezone, WebinarUser};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class WebinarControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some ticker data
        $data = Webinar::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.webinar.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar.index');
        $response->assertViewHas('webinars');
        
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
        $response = $this->get(route('admin.webinar.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        
        // Create a speaker using the factory
        $speaker = Speaker::factory()->create();

        // Prepare the data for the POST request
        $data = [
            'speaker' => $speaker->id,
            'title' => 'Test Webinar',
            'industry' => 'Technology',
            'webinar_date' => '2024-08-30',
            'global_zone' => ['PST', 'EST'],
            'timezone' => 1,
            'synopsis' => 'This is a test synopsis for the webinar.',
            'youtube' => 'https://youtube.com/watch?v=test',
            'status' => 1,
            'meta_tag_title' => 'Test Webinar Meta Title',
            'meta_tag_keywords' => 'webinar, test',
            'meta_tag_description' => 'This is a test webinar description.',
        ];

        // Perform the POST request to store the webinar
        $response = $this->post(route('admin.webinar.store'), $data);

        // Check if the new webinar was created in the database
        $this->assertDatabaseHas('webinars', [
            'title' => 'Test Webinar',
        ]);

        // Check if the response redirects to the webinar index page
        $response->assertRedirect(route('admin.webinar.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Webinar created successfully');
    }   
    
    public function test_update()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a speaker and a webinar using the factory
        $speaker = Speaker::factory()->create();
        $webinar = Webinar::factory()->create([
            'speaker_id' => $speaker->id,
            'title' => 'Old Webinar Title',
        ]);

        // Prepare the updated data
        $updatedData = [
            'speaker' => $speaker->id,
            'title' => 'Updated Webinar Title',
            'synopsis' => 'Updated synopsis for the webinar.',
            'industry' => 'Updated Industry',
            'webinar_date' => '2024-09-01',
            'global_zone' => ['PST', 'EST'],
            'timezone' => 1,
            'youtube' => 'https://youtube.com/watch?v=updated',
            'status' => 1,
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_keywords' => 'updated, webinar',
            'meta_tag_description' => 'Updated meta description.',
        ];

        // Perform the PUT request to update the webinar
        $response = $this->post(route('admin.webinar.update', $webinar), $updatedData);

        // Check if the webinar was updated in the database
        $this->assertDatabaseHas('webinars', [
            'title' => 'Updated Webinar Title',
            'synopsis' => 'Updated synopsis for the webinar.',
        ]);

        // Check if the response redirects to the webinar index page
        $response->assertRedirect(route('admin.webinar.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Webinar updated successfully');
    }

    public function test_test()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');


        // Arrange: Create a Webinar, Speaker, and Timezone using factories
        $speaker = Speaker::factory()->create();
        $timezone = Timezone::factory()->create();
        $webinar = Webinar::factory()->create([
            'speaker_id' => $speaker->id,
            'timezone_id' => $timezone->id,
        ]);

        // Act: Call the edit method on the controller
        $response = $this->get(route('admin.webinar.edit', $webinar->id));

        // Assert: Check that the correct view is returned with the correct data
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar.update');
        $response->assertViewHas('webinar', $webinar);
        $response->assertViewHas('speakers');
        $response->assertViewHas('timezones');

        // Optionally, you can also assert that the `speakers` and `timezones` are not empty
        $this->assertNotEmpty($response->viewData('speakers'));
        $this->assertNotEmpty($response->viewData('timezones'));
    }

    public function test_user()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some ticker data
        $data = WebinarUser::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.webinar.users'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.webinar.users');
        $response->assertViewHas('users');
        
        // Check if the service data are in the view
        foreach ($data as $val) {
            $response->assertSee($val->name);
        }
    }
    
}

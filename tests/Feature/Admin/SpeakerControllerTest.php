<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Speaker};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class SpeakerControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some speaker data
        $data = Speaker::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.speaker.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.speaker.index');
        $response->assertViewHas('speakers');
        
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
        $response = $this->get(route('admin.speaker.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.speaker.create');
        
    }

    public function test_store()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $image = UploadedFile::fake()->image('profile.jpg');

        $response = $this->post(route('admin.speaker.store'), [
            'name' => 'Test Speaker',
            'email' => 'test@example.com',
            'designation' => 'Test Designation',
            'image' => $image,
            'image_alt' => 'Image Alt Text',
        ]);

        $response->assertRedirect(route('admin.speaker.index'));
        $response->assertSessionHas('success', 'Speaker created successfully');

        $this->assertDatabaseHas('speakers', [
            'name' => 'Test Speaker',
            'email' => 'test@example.com',
            'designation' => 'Test Designation',
            'image_alt' => 'Image Alt Text',
        ]);


    }

    public function test_edit()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample Speaker to edit
        $speaker = Speaker::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'designation' => 'Speaker',
            'image_alt' => 'John Image Alt',
        ]);

        // Simulate a GET request to the edit route
        $response = $this->get(route('admin.speaker.edit', $speaker->id));

        // Assert: Check if the response is successful
        $response->assertStatus(200);

        // Assert: Check if the response view is correct
        $response->assertViewIs('admin.speaker.edit');

        // Assert: Check if the view has the correct data
        $response->assertViewHas('speaker', $speaker);
    }
    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        // Create a speaker and a category
        $speaker = Speaker::factory()->create();
    

        // Mock file upload
        Storage::fake('public');
        $image = UploadedFile::fake()->image('image.jpg');

        $data = [
            'name' => 'New speaker Name',
            'image_alt' => 'Image alt val',
            'email' => 'asif@yopmail.com',
            'designation' => 'Test designation',
            'image'=>$image
        ];

        // Act
        $response = $this->post(route('admin.speaker.update', $speaker->id), $data);
        // Assert
        $response->assertRedirect(route('admin.speaker.index'));
        $response->assertSessionHas('success', 'Speaker updated successfully');

        $speaker->refresh();

        // Check if the speaker was updated in the database
        $this->assertEquals($data['name'], $speaker->name);
        $this->assertEquals($data['image_alt'], $speaker->image_alt);
        $this->assertEquals($data['email'], $speaker->email);
        $this->assertEquals($data['designation'], $speaker->designation);

    }
    
    
}

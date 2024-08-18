<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Position};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class PositionControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.positions.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.position.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.positions.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.position.create');
    }

    public function test_store_position()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Prepare the data for the POST request
        $data = [
            'title' => 'Software Engineer',
            'description' => 'This is a test description for the position.',
            'location' => 'New York',
            'experience' => '2-4 years',
            'vacancy' => 3,
            'duration' => 'Full-time',
            'status' => 1,
            'sort' => 1,
        ];

        // Perform the POST request to store the position
        $response = $this->post(route('admin.positions.store'), $data);

        // Check if the new position was created in the database
        $this->assertDatabaseHas('positions', [
            'title' => 'Software Engineer',
            'slug' => 'software-engineer',
            'description' => 'This is a test description for the position.',
            'location' => 'New York',
            'experience' => '2-4 years',
            'vacancy' => 3,
            'duration' => 'Full-time',
            'status' => 1,
            'sort' => 1,
        ]);

        // Check if the response redirects to the positions index page
        $response->assertRedirect(route('admin.positions.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Position created successfully');
    }

    public function test_edit_view_is_rendered_correctly()
    {
        // Create a dummy position item
        $position = Position::factory()->create();

        // Act as an admin or user with the necessary permissions
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the edit route
        $response = $this->get(route('admin.positions.edit', $position->id));

        // Assert the response status is OK (200)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.position.edit');

        // Assert that the view receives the correct data
        $response->assertViewHas('position', $position);
    }

    public function test_update_position()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create an existing position
        $position = Position::factory()->create([
            'title' => 'Junior Developer',
            'description' => 'Initial description.',
            'location' => 'San Francisco',
            'experience' => '1-2 years',
            'vacancy' => 2,
            'duration' => 'Part-time',
            'status' => 1,
            'sort' => 1,
        ]);

        // Prepare the updated data
        $updatedData = [
            'title' => 'Senior Developer',
            'description' => 'Updated description for the position.',
            'location' => 'Los Angeles',
            'experience' => '5+ years',
            'vacancy' => 5,
            'duration' => 'Full-time',
            'status' => 1,
            'sort' => 2,
        ];

        // Perform the PUT request to update the position
        $response = $this->post(route('admin.positions.update', $position->id), $updatedData);

        // Check if the position was updated in the database
        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'title' => 'Senior Developer',
            'slug' => 'senior-developer',
            'description' => 'Updated description for the position.',
            'location' => 'Los Angeles',
            'experience' => '5+ years',
            'vacancy' => 5,
            'duration' => 'Full-time',
            'status' => 1,
            'sort' => 2,
        ]);

        // Check if the response redirects to the positions index page
        $response->assertRedirect(route('admin.positions.index'));

        // Check if the session contains the success message
        $response->assertSessionHas('success', 'Position updated successfully');
    }



    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a position record with status = 1
        $data = Position::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.positions.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Position updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('positions', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.positions.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('positions', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Position record
        $data = Position::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.positions.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Position delete successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('positions', [
            'id' => $data->id,
        ]);
    }


}

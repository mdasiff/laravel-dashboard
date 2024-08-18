<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{LifeMerino};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LifeMerinoControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.life_merino.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.life_merino.index');
    }

    
    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.life_merino.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.life_merino.create');
    }

    public function test_store_life_merino()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create fake data for the request
        $data = [
            'image_alt' => 'Sample Image Alt Text',
            'sort' => 1,
            'status' => 1,
            'image' => UploadedFile::fake()->image('sample.jpg')
        ];

        // Send a POST request to the store route
        $response = $this->post(route('admin.life_merino.store'), $data);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.life_merino.index'));

        // Assert a success message is present in the session
        $response->assertSessionHas('success', 'Life@Mrino created successfully');

        // Assert the LifeMerino record was created in the database
        $this->assertDatabaseHas('life_merinos', [
            'image_alt' => 'Sample Image Alt Text',
            'sort' => 1,
            'status' => 1,
        ]);
    }

    public function test_displays_the_edit_view()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        
        $data = LifeMerino::factory()->create();

        // Perform the GET request to the edit route
        $response = $this->get(route('admin.life_merino.edit', $data->id));

        // Assertions
        $response->assertStatus(200); // Asserts that the response status is 200 (OK)
        $response->assertViewIs('admin.life_merino.edit'); // Asserts that the correct view is returned
        $response->assertViewHas('life_merino', $data); // Asserts that the 'data' variable is passed to the view

        $response->assertViewHas('life_merino', $data);
    }

    public function test_update_life_merino()
    {

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a LifeMerino record
        $lifeMerino = LifeMerino::factory()->create([
            'image_alt' => 'Original Alt Text',
            'sort' => 1,
            'status' => 1,
            'image' => 'original-image.jpg'
        ]);

        // Prepare updated data
        $updatedData = [
            'image_alt' => 'Updated Alt Text',
            'image' => UploadedFile::fake()->image('sample.jpg'),
            'sort' => 2,
            'status' => 0,
        ];

        // Send a POST request to update the record
        $response = $this->post(route('admin.life_merino.update', $lifeMerino->id), $updatedData);

        // Assert the response is a redirect
        $response->assertRedirect(route('admin.life_merino.index'));

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Life@Mrino updated successfully');

        // Assert the record was updated in the database
        $this->assertDatabaseHas('life_merinos', [
            'id' => $lifeMerino->id,
            'image_alt' => 'Updated Alt Text',
            'sort' => 2,
            'status' => 0,
        ]);
    }

    public function test_status_update_life_merino()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a LifeMerino record with status = 1
        $lifeMerino = LifeMerino::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.life_merino.status_update', $lifeMerino->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Life@Mrino updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('life_merinos', [
            'id' => $lifeMerino->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.life_merino.status_update', $lifeMerino->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('life_merinos', [
            'id' => $lifeMerino->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete_life_merino()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a LifeMerino record
        $lifeMerino = LifeMerino::factory()->create();

        // Send a DELETE request to delete the LifeMerino record
        $response = $this->get(route('admin.life_merino.delete', $lifeMerino->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Life@Mrino delete successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('life_merinos', [
            'id' => $lifeMerino->id,
        ]);
    }

}

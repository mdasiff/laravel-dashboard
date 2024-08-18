<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Ticker};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class TickerControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some ticker data
        $data = Ticker::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.ticker.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.ticker.index');
        $response->assertViewHas('ticker');
        
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
        $response = $this->get(route('admin.ticker.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.ticker.create');
        
    }

    public function test_store()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');


        // Prepare the request data
        $data = [
            'counter' => 1,
            'tag' => 'tag',
            'description' => 'this is description',
            'status' => 1,
        ];

        // Post request to store the ticker
        $response = $this->post(route('admin.ticker.store'), $data);

        // Assert the response and database changes
        $response->assertRedirect(route('admin.ticker.index'));
        $response->assertSessionHas('success', 'Ticker created successfully');

        // Assert the ticker was stored in the database
        $this->assertDatabaseHas('tickers', [
            'counter' => 1,
            'tag' => 'tag',
            'description' => 'this is description',
            'status' => 1,
        ]);

    }

    public function test_edit()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ticker instance using factory
        $ticker = Ticker::factory()->create();

        // Send a GET request to the edit route
        $response = $this->get(route('admin.ticker.edit', $ticker->id));

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the view is the correct one
        $response->assertViewIs('admin.ticker.edit');

        // Assert the view has the expected data
        $response->assertViewHas('ticker', $ticker);
    }

    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        // Create a ticker and a category
        $ticker = Ticker::factory()->create();
    
        
        $image = UploadedFile::fake()->image('image.jpg');

        $data = [
            'counter' => 1,
            'tag' => 'tag',
            'description' => 'this is description',
            'status' => 1,
        ];

        // Act
        $response = $this->post(route('admin.ticker.update', $ticker->id), $data);
        // Assert
        $response->assertRedirect(route('admin.ticker.index'));
        $response->assertSessionHas('success', 'Ticker updated successfully');

        $ticker->refresh();

        // Check if the ticker was updated in the database
        $this->assertEquals($data['counter'], $ticker->counter);
        $this->assertEquals($data['tag'], $ticker->tag);
        $this->assertEquals($data['description'], $ticker->description);
        $this->assertEquals($data['status'], $ticker->status);

    }
    
    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ticker record with status = 1
        $data = Ticker::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.ticker.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Ticker updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('tickers', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.ticker.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('tickers', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ticker record
        $data = Ticker::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.ticker.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Ticker deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('tickers', [
            'id' => $data->id,
        ]);
    }
}

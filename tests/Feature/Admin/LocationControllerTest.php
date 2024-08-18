<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Location, Country};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.locations.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.location.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.locations.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.location.create');
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create fake data for the request
        $data = [
            'title' => 'Test title',
            'address_1' => 'add 1',
            'address_1' => 'add 2',
            'city' => 'Delhi',
            'country_id' => 1,
            'zip' => 123456
        ];

        // Send a POST request to the store route
        $response = $this->post(route('admin.locations.store'), $data);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.locations.index'));

        // Assert a success message is present in the session
        $response->assertSessionHas('success', 'Location created successfully.');

        // Assert the LifeMerino record was created in the database
        $this->assertDatabaseHas('locations', [
            'title' => 'Test title',
            'address_1' => 'add 1',
            'address_1' => 'add 2',
            'city' => 'Delhi',
            'country_id' => 1,
            'zip' => 123456
        ]);
    }

    public function test_edit_location_view_is_accessible()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Location record
        $location = Location::factory()->create();

        // Create some Country records
        $countries = Country::factory()->count(3)->create();

        // Send a GET request to the edit route
        $response = $this->get(route('admin.locations.edit', $location->id));

        // Assert the response is successful (200 OK)
        $response->assertStatus(200);

        // Assert the view returned is correct
        $response->assertViewIs('admin.location.update');

        // Assert the location and countries data are passed to the view
        $response->assertViewHas('location', $location);
        $response->assertViewHas('countries', function ($viewCountries) use ($countries) {
            return $viewCountries->pluck('id')->toArray() === $countries->pluck('id')->toArray();
        });
    }

    public function test_update_location()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Location record
        $location = Location::factory()->create();

        // Create a Country record
        $country = Country::factory()->create();

        // Prepare the update data
        $updateData = [
            'title' => 'Updated Location Title',
            'address_1' => 'Updated Address 1',
            'address_2' => 'Updated Address 2',
            'zip' => 12345,
            'city' => 'Updated City',
            'country_id' => $country->id,
            'phone' => 123567890,
            'fax' => 987654321,
            'email' => 'updated@example.com',
            'cin' => 'Updated CIN',
            'status' => 1,
        ];

        // Send a POST request to the update route
        $response = $this->post(route('admin.locations.update', $location->id), $updateData);

        // Assert the response redirects to the index page with a success message
        $response->assertRedirect(route('admin.locations.index'));
        $response->assertSessionHas('success', 'Location updated successfully.');

        // Assert the location was updated in the database
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'title' => 'Updated Location Title',
            'address_1' => 'Updated Address 1',
            'address_2' => 'Updated Address 2',
            'zip' => 12345,
            'city' => 'Updated City',
            'country_id' => $country->id,
            'phone' => 123567890,
            'fax' => 987654321,
            'email' => 'updated@example.com',
            'cin' => 'Updated CIN',
            'status' => 1,
        ]);
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Location record with status = 1
        $location = Location::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.locations.status_update', $location->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Location status updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.locations.status_update', $location->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('locations', [
            'id' => $location->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Location record
        $Location = Location::factory()->create();

        // Send a DELETE request to delete the Location record
        $response = $this->get(route('admin.locations.delete', $Location->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Location deleted successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('locations', [
            'id' => $Location->id,
        ]);
    }

}

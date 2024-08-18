<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Country;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class CountryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_countries_index() {

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create some sample countries
        $countries = Country::factory()->count(5)->create();

        // Send a request to the index route
        $response = $this->get(route('admin.country.index'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.country.index');

        // Assert that the view has the countries data
        $response->assertViewHas('countries', function($viewCountries) use ($countries) {
            return $viewCountries->count() === 5;
        });
    }

    public function test_create_view_is_accessible()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the route that shows the create form
        $response = $this->get(route('admin.country.create'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.country.create');
    }

    public function test_store_creates_country()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Simulate form data
        $formData = [
            'name' => 'Test Country',
            'status' => 1,
            'image' => UploadedFile::fake()->image('country.jpg'),
        ];

        // Make a POST request to the store route
        $response = $this->post(route('admin.country.store'), $formData);

        // Assert that the country was created in the database
        $this->assertDatabaseHas('countries', [
            'name' => 'Test Country',
        ]);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.country.index'));

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Country created successfully.');
    }
    public function test_edit_displays_edit_view_with_country()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample country
        $country = Country::factory()->create();

        // Make a GET request to the edit route
        $response = $this->get(route('admin.country.edit', $country->id));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the edit view is returned
        $response->assertViewIs('admin.country.update');

        // Assert the country data is passed to the view
        $response->assertViewHas('country', $country);
    }

    public function test_update_updates_country_and_redirects()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample country
        $country = Country::factory()->create();

        // Data to update the country
        $updateData = [
            'name' => 'Updated Country Name',
            'status' => 1,  // Assuming status is boolean
        ];

        // Mock the image upload
        $this->withoutExceptionHandling();
        $file = UploadedFile::fake()->image('country.jpg');
        $updateData['image'] = $file;

        // Make a POST request to update the country
        $response = $this->post(route('admin.country.update', $country->id), $updateData);

        // Assert the country was updated
        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'name' => 'Updated Country Name',
        ]);

        // Assert the user is redirected to the index page with success message
        $response->assertRedirect(route('admin.country.index'));
        $response->assertSessionHas('success', 'Country updated successfully.');
    }
    public function test_status_update_toggles()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample country with status 1
        $country = Country::factory()->create(['status' => 1]);

        // Make a POST request to toggle the status
        $response = $this->get(route('admin.country.status_update', $country->id));

        // Assert the country status was toggled to 0
        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'status' => 0,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Country status updated successfully.');

        // Make another POST request to toggle the status back to 1
        $response = $this->get(route('admin.country.status_update', $country->id));

        // Assert the country status was toggled back to 1
        $this->assertDatabaseHas('countries', [
            'id' => $country->id,
            'status' => 1,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Country status updated successfully.');
    }

    public function test_delete_country()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a country and a country associated with it
        $country = Country::factory()->create();

        // Perform the delete request
        $response = $this->get(route('admin.country.delete', $country->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Location deleted successfully.'); // Asserts the session success message

        // Assert that the country no longer exists in the database
        $this->assertDatabaseMissing('countries', [
            'id' => $country->id,
        ]);
    }


}

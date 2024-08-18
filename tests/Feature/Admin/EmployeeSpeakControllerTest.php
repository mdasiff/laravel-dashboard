<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\EmployeeSpeak;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class EmployeeSpeakControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_employee_speeks_index() {

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create some sample emp speaks
        $data = EmployeeSpeak::factory()->count(5)->create();

        // Send a request to the index route
        $response = $this->get(route('admin.employee-speak.index'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.employee_speak.index');

        // Assert that the view has the emp speaks data
        $response->assertViewHas('employee_speaks', function($view) use ($data) {
            return $view->count() === 5;
        });
    }

    public function test_create_view_is_accessible()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the route that shows the create form
        $response = $this->get(route('admin.employee-speak.create'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.employee_speak.create');
    }

    public function test_store_creates_employee_speak()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Simulate form data
        $formData = [
            'name' => 'Test',
            'designation'=>'Test designation',
            'description'=>'Test description',
            'sort'=>1,
            'status'=>1,
            'status' => 1,
            'image' => UploadedFile::fake()->image('abc.jpg')
        ];

        // Make a POST request to the store route
        $response = $this->post(route('admin.employee-speak.store'), $formData);

        // Assert that the emp speak was created in the database
        $this->assertDatabaseHas('employee_speaks', [
            'name' => 'Test',
            'designation'=>'Test designation',
            'description'=>'Test description',
            'sort'=>1,
            'status'=>1,
            'status' => 1
        ]);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.employee-speak.index'));

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Employee Speak created successfully');
    }

    public function test_edit_displays_edit_view_with_emp_speak()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample data
        $data = EmployeeSpeak::factory()->create();

        // Make a GET request to the edit route
        $response = $this->get(route('admin.employee-speak.edit', $data->id));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the edit view is returned
        $response->assertViewIs('admin.employee_speak.edit');

        // Assert the data data is passed to the view
        $response->assertViewHas('employee_speak', $data);
    }

    public function test_update_updates_emp_speak()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample emp speaks
        $data = EmployeeSpeak::factory()->create();

        // Data to update the EmployeeSpeak
        $updateData = [
            'name' => 'Updated Test',
            'designation'=>'Updated Test designation',
            'description'=>'Updated Test description',
            'sort'=>1,
            'status'=>1,
            'status' => 1
        ];

        // Mock the image upload
        $this->withoutExceptionHandling();
        $file = UploadedFile::fake()->image('abc.jpg');
        $updateData['image'] = $file;

        // Make a POST request to update the emp speaks
        $response = $this->post(route('admin.employee-speak.update', $data->id), $updateData);

        // Assert the emp speaks was updated
        $this->assertDatabaseHas('employee_speaks', [
            'id' => $data->id,
            'name' => 'Updated Test',
            'designation'=>'Updated Test designation',
            'description'=>'Updated Test description',
            'sort'=>1,
            'status'=>1,
            'status' => 1
        ]);

        // Assert the user is redirected to the index page with success message
        $response->assertRedirect(route('admin.employee-speak.index'));
        $response->assertSessionHas('success', 'Employee Speak updated successfully');
    }
    public function test_status_update_toggles()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample emp speak with status 1
        $data = EmployeeSpeak::factory()->create(['status' => 1]);

        // Make a POST request to toggle the status
        $response = $this->get(route('admin.employee-speak.status_update', $data->id));

        // Assert the data status was toggled to 0
        $this->assertDatabaseHas('employee_speaks', [
            'id' => $data->id,
            'status' => 0,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Employee Speak updated successfully.');

        // Make another POST request to toggle the status back to 1
        $response = $this->get(route('admin.employee-speak.status_update', $data->id));

        // Assert the data status was toggled back to 1
        $this->assertDatabaseHas('employee_speaks', [
            'id' => $data->id,
            'status' => 1,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Employee Speak updated successfully.');
    }

    public function test_delete()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a emp speak
        $data = EmployeeSpeak::factory()->create();

        // Perform the delete request
        $response = $this->get(route('admin.employee-speak.delete', $data->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Employee Speak delete successfully.'); // Asserts the session success message

        // Assert that the emp speak no longer exists in the database
        $this->assertDatabaseMissing('employee_speaks', [
            'id' => $data->id,
        ]);
    }

}

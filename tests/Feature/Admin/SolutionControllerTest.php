<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{SolutionCategory, Solution};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class SolutionControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some Solution data
        $data = Solution::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.solution.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution.index');
        $response->assertViewHas('solutions');
        
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
        $response = $this->get(route('admin.solution.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution.create');
        
    }

    public function test_store()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');


        // Arrange
        // Create a category
        $category = SolutionCategory::factory()->create();

        // Fake storage
        Storage::fake('public');

        // Mock file uploads
        $image = UploadedFile::fake()->image('image.jpg');
        $file = UploadedFile::fake()->create('document.pdf');

        $data = [
            'name' => 'New Solution Name',
            'category' => $category->id,
            'description' => 'Solution description',
            'status' => 1,
            'image' => $image,
            'file' => $file
        ];

        // Act
        $response = $this->post(route('admin.solution.store'), $data);

        // Assert
        $response->assertRedirect(route('admin.solution.index'));
        $response->assertSessionHas('success', 'Solution created successfully');

        // Check if the solution was created in the database
        $this->assertDatabaseHas('solutions', [
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'solution_category_id' => $data['category']
        ]);
    }

    public function test_edit_solution()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a solution category and a solution using the factory
        $category = SolutionCategory::factory()->create();
        $solution = Solution::factory()->create([
            'solution_category_id' => $category->id,
            'name' => 'Test Solution',
        ]);

        // Perform the GET request to the edit method
        $response = $this->get(route('admin.solution.edit', $solution->id));

        // Assert the view is rendered successfully
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution.edit');
        
        // Assert the solution data is passed to the view
        $response->assertViewHas('sc', function($viewSolution) use ($solution) {
            return $viewSolution->id === $solution->id && $viewSolution->name === $solution->name;
        });

        // Assert the categories data is passed to the view
        $response->assertViewHas('categories', function($viewCategories) use ($category) {
            return $viewCategories->contains('id', $category->id);
        });
    }


    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        // Create a solution and a category
        $solution = Solution::factory()->create();
        $category = SolutionCategory::factory()->create();

        // Mock file upload
        Storage::fake('public');
        $image = UploadedFile::fake()->image('image.jpg');
        $file = UploadedFile::fake()->create('document.pdf');

        $data = [
            'name' => 'Updated Solution Name',
            'category' => $category->id,
            'description' => 'Updated description',
            'status' => 1,
            'image' => $image,
            'file' => $file
        ];

        // Act
        $response = $this->post(route('admin.solution.update', $solution->id), $data);
        // Assert
        $response->assertRedirect(route('admin.solution.index'));
        $response->assertSessionHas('success', 'Solution updated successfully');

        $solution->refresh();

        // Check if the solution was updated in the database
        $this->assertEquals($data['name'], $solution->name);
        $this->assertEquals($data['description'], $solution->description);
        $this->assertEquals($data['status'], $solution->status);
        $this->assertEquals($data['category'], $solution->solution_category_id);

    }
    
    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Solution record with status = 1
        $data = Solution::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.solution.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Solution updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('solutions', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.solution.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('solutions', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Service record
        $data = Solution::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.solution.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Solution deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('solutions', [
            'id' => $data->id,
        ]);
    }
    
}

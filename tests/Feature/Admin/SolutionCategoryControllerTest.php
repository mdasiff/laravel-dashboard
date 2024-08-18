<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{SolutionCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class SolutionCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create some Service data
        $data = SolutionCategory::factory()->count(3)->create();

        // Act: Make a request to the index page
        $response = $this->get(route('admin.solution-category.index'));

        // Assert: Check the response status and view data
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution-category.index');
        $response->assertViewHas('solution_categories');
        
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
        $response = $this->get(route('admin.solution-category.create'));

        // Assert: Check the response status and view
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution-category.create');
        
    }

    public function test_store()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        $data = [
            'name' => 'Test Category',
            'slug' => 'test-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'Test Description',
            'meta_tag_title' => 'Test Meta Tag Title',
            'meta_tag_description' => 'Test Meta Tag Description',
            'meta_tag_keywords' => 'keyword1, keyword2',
            'image' => UploadedFile::fake()->image('test-image.jpg'),
        ];

        // Act
        $response = $this->post(route('admin.solution-category.store'), $data);

        // Assert
        $response->assertRedirect(route('admin.solution-category.index'));
        $response->assertSessionHas('success', 'Solution Category created successfully');
        $this->assertDatabaseHas('solution_categories', [
            'name' => 'Test Category',
            'slug' => Str::slug('Test Category'),
            'description' => 'Test Description',
        ]);

    }

    public function test_edit()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange: Create a sample SolutionCategory
        $solutionCategory = SolutionCategory::create([
            'name' => 'Sample Category',
            'slug' => 'sample-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'Sample Description',
            'meta_tag_title' => 'Sample Meta Tag Title',
            'meta_tag_description' => 'Sample Meta Tag Description',
            'meta_tag_keywords' => 'samplekeyword1, samplekeyword2',
        ]);

        // Act: Send a GET request to the edit route
        $response = $this->get(route('admin.solution-category.edit', $solutionCategory->id));

        // Assert: Check if the response is successful and contains the expected data
        $response->assertStatus(200);
        $response->assertViewIs('admin.solution-category.edit');
        $response->assertViewHas('sc', $solutionCategory);

    }

    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Arrange
        $existingCategory = SolutionCategory::create([
            'name' => 'Old Category',
            'slug' => 'old-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'Old Description',
            'meta_tag_title' => 'Old Meta Tag Title',
            'meta_tag_description' => 'Old Meta Tag Description',
            'meta_tag_keywords' => 'oldkeyword1, oldkeyword2',
        ]);

        $data = [
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'sort' => 2,
            'status' => 0,
            'description' => 'Updated Description',
            'meta_tag_title' => 'Updated Meta Tag Title',
            'meta_tag_description' => 'Updated Meta Tag Description',
            'meta_tag_keywords' => 'newkeyword1, newkeyword2',
            'image' => UploadedFile::fake()->image('updated-image.jpg'),
        ];

        // Act
        $response = $this->post(route('admin.solution-category.update', $existingCategory->id), $data);

        // Assert
        $response->assertRedirect(route('admin.solution-category.index'));
        $response->assertSessionHas('success', 'Solution Category updated successfully');

        // Verify that the category was updated in the database
        $this->assertDatabaseHas('solution_categories', [
            'id' => $existingCategory->id,
            'name' => 'Updated Category',
            'slug' => Str::slug('Updated Category'),
            'description' => 'Updated Description',
            'status' => 0,
        ]);
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a SolutionCategory record with status = 1
        $data = SolutionCategory::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.solution-category.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Solution Category updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('solution_categories', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.solution-category.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('solution_categories', [
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
        $data = SolutionCategory::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.solution-category.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Solution Category deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('solution_categories', [
            'id' => $data->id,
        ]);
    }
    
}

<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Industry, IndustryCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class IndustryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index() {

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create some sample data
        $data = Industry::factory()->count(5)->create();

        // Send a request to the index route
        $response = $this->get(route('admin.industry.index'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.industry.index');

        // Assert that the view has the data data
        $response->assertViewHas('industries', function($view) use ($data) {
            return $view->count() === 5;
        });
    }

    public function test_create_view_is_accessible()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the route that shows the create form
        $response = $this->get(route('admin.industry.create'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.industry.create');
    }

    public function test_store_industry_creates()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        
        // Fake storage for image and file uploads
        Storage::fake('public');

        // Prepare request data
        $image = UploadedFile::fake()->image('industry.jpg');
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $data = [
            'category' => 1, // Assume category ID 1 exists
            'name' => 'New Industry',
            'description' => 'This is a description for the new industry.',
            'status' => 1,
            'sort' => 1,
            'slug' => 'new-industry',
            'meta_tag_title' => 'New Meta Title',
            'meta_tag_description' => 'New Meta Description',
            'meta_tag_keywords' => 'new,meta,keywords',
            'image' => $image,
            'file' => $file,
        ];

        // Make a POST request to the store route
        $response = $this->post(route('admin.industry.store'), $data);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.industry.index'));

        // Assert the session has the success message
        $response->assertSessionHas('success', 'Industry created successfully');

        // Assert the industry was created in the database
        $this->assertDatabaseHas('industries', [
            'name' => 'New Industry',
            'slug' => 'new-industry',
            'description' => 'This is a description for the new industry.',
        ]);

    }


    public function test_edit_displays_industry_edit_form()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a fake industry category
        $category = IndustryCategory::factory()->create();

        // Create a fake industry associated with the category
        $industry = Industry::factory()->create([
            'industry_category_id' => $category->id,
        ]);

        // Make a GET request to the edit route
        $response = $this->get(route('admin.industry.edit', $industry->id));

        // Assert the response is successful (status code 200)
        $response->assertStatus(200);

        // Assert that the edit view is returned
        $response->assertViewIs('admin.industry.edit');

        // Assert that the industry and categories data are passed to the view
        $response->assertViewHas('ic', $industry);
        $response->assertViewHas('categories', function ($categories) use ($category) {
            return $categories->contains($category);
        });
    }


    public function test_update_with_image_and_file()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Setup
        Storage::fake('public');

        $industry = Industry::create([
            'name' => 'Old Industry',
            'slug' => 'old-industry',
            'industry_category_id' => 1,
            'description' => 'Old Description',
            'sort' => 1,
            'status' => 1,
            'meta_tag_title' => 'Old Meta Title',
            'meta_tag_description' => 'Old Meta Description',
            'meta_tag_keywords' => 'old, keywords',
        ]);

        $updatedImage = UploadedFile::fake()->image('new-image.jpg');
        $file = UploadedFile::fake()->create('document.pdf', 100);

        $response = $this->post(route('admin.industry.update', $industry), [
            'name' => 'Updated Industry',
            'category' => 2,
            'description' => 'Updated Description',
            'sort' => 2,
            'status' => 1,
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
            'image' => $updatedImage,
            'file' => $file,
        ]);

        //dd($response);
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Industry updated successfully');

        // Assert that the industry was updated
        $industry->refresh();
        $this->assertEquals('Updated Industry', $industry->name);
        $this->assertEquals('Updated Description', $industry->description);
        $this->assertEquals(2, $industry->sort);
        $this->assertEquals(1, $industry->status);
        $this->assertEquals('Updated Meta Title', $industry->meta_tag_title);
        $this->assertEquals('Updated Meta Description', $industry->meta_tag_description);
        $this->assertEquals('updated, keywords', $industry->meta_tag_keywords);
        
    }

    public function test_status_update_toggles()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample emp speak with status 1
        $data = Industry::factory()->create(['status' => 1]);

        // Make a POST request to toggle the status
        $response = $this->get(route('admin.industry.status_update', $data->id));

        // Assert the data status was toggled to 0
        $this->assertDatabaseHas('industries', [
            'id' => $data->id,
            'status' => 0,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Industry updated successfully');

        // Make another POST request to toggle the status back to 1
        $response = $this->get(route('admin.industry.status_update', $data->id));

        // Assert the data status was toggled back to 1
        $this->assertDatabaseHas('industries', [
            'id' => $data->id,
            'status' => 1,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Industry updated successfully');
    }

    public function test_delete()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a emp speak
        $data = Industry::factory()->create();

        // Perform the delete request
        $response = $this->get(route('admin.industry.delete', $data->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Industry deleted successfully'); // Asserts the session success message

        // Assert that the emp speak no longer exists in the database
        $this->assertDatabaseMissing('industries', [
            'id' => $data->id,
        ]);
    }

}

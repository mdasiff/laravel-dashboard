<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\IndustryCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class IndustryCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index() {

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create some sample data
        $data = IndustryCategory::factory()->count(5)->create();

        // Send a request to the index route
        $response = $this->get(route('admin.industry-category.index'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.industry-category.index');

        // Assert that the view has the data data
        $response->assertViewHas('industry_categories', function($view) use ($data) {
            return $view->count() === 5;
        });
    }

    public function test_create_view_is_accessible()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the route that shows the create form
        $response = $this->get(route('admin.industry-category.create'));

        // Assert that the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.industry-category.create');
    }

    public function test_store_industry_category_creates()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        

        // Prepare request data
        $data = [
            'name' => 'New Industry Category',
            'slug' => 'new-industry-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'This is a description for the new industry category.',
            'meta_tag_title' => 'Meta Title',
            'meta_tag_description' => 'Meta Description',
            'meta_tag_keywords' => 'meta,keywords',
            'image' => UploadedFile::fake()->image('abc.jpg')
        ];

        // Make a POST request to the store route
        $response = $this->post(route('admin.industry-category.store'), $data);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.industry-category.index'));

        // Assert the session has the success message
        $response->assertSessionHas('success', 'Industry Category created successfully');

        // Assert the category was created in the database
        $this->assertDatabaseHas('industry_categories', [
            'name' => 'New Industry Category',
            'slug' => 'new-industry-category',
            'description' => 'This is a description for the new industry category.',
        ]);

    }


    public function test_edit_displays_edit_view_with()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample data
        $data = IndustryCategory::factory()->create();

        // Make a GET request to the edit route
        $response = $this->get(route('admin.industry-category.edit', $data->id));

        // Assert the response status is 200 (OK)
        $response->assertStatus(200);

        // Assert the edit view is returned
        $response->assertViewIs('admin.industry-category.edit');

        // Assert the data data is passed to the view
        $response->assertViewHas('ic', $data);
    }

    public function test_update_industry_category_updates()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a fake industry category
        $industryCategory = IndustryCategory::factory()->create([
            'name' => 'Old Industry Category',
            'slug' => 'old-industry-category',
        ]);

        // Create a fake image for the request
        Storage::fake('public');
        $image = UploadedFile::fake()->image('industry.jpg');

        // Prepare request data for updating the category
        $data = [
            'name' => 'Updated Industry Category',
            'slug' => 'updated-industry-category',
            'sort' => 1,
            'status' => 1,
            'description' => 'This is an updated description for the industry category.',
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated,meta,keywords',
            'image' => $image,
        ];

        // Make a POST request to the update route
        $response = $this->post(route('admin.industry-category.update', $industryCategory->id), $data);

        // Assert the response redirects to the index route
        $response->assertRedirect(route('admin.industry-category.index'));

        // Assert the session has the success message
        $response->assertSessionHas('success', 'Industry Category updated successfully');

        // Assert the category was updated in the database
        $this->assertDatabaseHas('industry_categories', [
            'id' => $industryCategory->id,
            'name' => 'Updated Industry Category',
            'slug' => 'updated-industry-category',
            'description' => 'This is an updated description for the industry category.',
        ]);

    }


    
    public function test_status_update_toggles()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a sample emp speak with status 1
        $data = IndustryCategory::factory()->create(['status' => 1]);

        // Make a POST request to toggle the status
        $response = $this->get(route('admin.industry-category.status_update', $data->id));

        // Assert the data status was toggled to 0
        $this->assertDatabaseHas('industry_categories', [
            'id' => $data->id,
            'status' => 0,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Industry Category updated successfully');

        // Make another POST request to toggle the status back to 1
        $response = $this->get(route('admin.industry-category.status_update', $data->id));

        // Assert the data status was toggled back to 1
        $this->assertDatabaseHas('industry_categories', [
            'id' => $data->id,
            'status' => 1,
        ]);

        // Assert the user is redirected back with a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Industry Category updated successfully');
    }

    public function test_delete()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a emp speak
        $data = IndustryCategory::factory()->create();

        // Perform the delete request
        $response = $this->get(route('admin.industry-category.delete', $data->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Industry Category deleted successfully'); // Asserts the session success message

        // Assert that the emp speak no longer exists in the database
        $this->assertDatabaseMissing('industry_categories', [
            'id' => $data->id,
        ]);
    }

}

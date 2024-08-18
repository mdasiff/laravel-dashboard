<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{ProductCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class ProductCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.product-category.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product-category.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.product-category.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product-category.create');
    }

   

    public function test_edit_view_is_rendered_correctly()
    {
        // Create a dummy ProductCategory item
        $product_categories = ProductCategory::factory()->create();

        // Act as an admin or user with the necessary permissions
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the edit route
        $response = $this->get(route('admin.product-category.edit', $product_categories->id));

        // Assert the response status is OK (200)
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.product-category.edit');

        // Assert that the view receives the correct data
        $response->assertViewHas('sc', $product_categories);
    }

    public function test_store()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $image = UploadedFile::fake()->image('category-image.jpg');

        $data = [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'sort' => 1,
            'status' => 1,
            'description' => 'Category for electronic products',
            'row' => 1,
            'meta_tag_title' => 'Electronics',
            'meta_tag_description' => 'Category for electronic products',
            'meta_tag_keywords' => 'electronics, gadgets, technology',
            'image' => $image,
        ];

        // Act: Send a POST request to the store route
        $response = $this->post(route('admin.product-category.store'), $data);

        // Assert: Check if the category was stored and redirect was made
        $response->assertRedirect(route('admin.product-category.index'));
        $response->assertSessionHas('success', 'Category created successfully');

        // Assert: Check if the data was saved in the database
        $this->assertDatabaseHas('product_categories', [
            'name' => 'Electronics',
            'slug' => 'electronics',
            'sort' => 1,
            'status' => 1,
            'description' => 'Category for electronic products',
            'row' => 1,
            'meta_tag_title' => 'Electronics',
            'meta_tag_description' => 'Category for electronic products',
            'meta_tag_keywords' => 'electronics, gadgets, technology',
        ]);
    }

    public function test_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create an initial product category
        $productCategory = ProductCategory::create([
            'name' => 'Old Category',
            'slug' => 'old-category',
            'description' => 'Old description',
            'sort' => 1,
            'status' => 1,
            'row' => 1,
            'meta_tag_title' => 'Old Meta Title',
            'meta_tag_description' => 'Old Meta Description',
            'meta_tag_keywords' => 'old, keywords',
        ]);

        // Fake storage for image upload
        Storage::fake('public');

        // Prepare updated data
        $image = UploadedFile::fake()->image('updated-category-image.jpg');

        $updatedData = [
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'description' => 'Updated description',
            'sort' => 2,
            'status' => 0,
            'row' => 2,
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
            'image' => $image,
        ];

        // Act: Send a PUT request to the update route
        $response = $this->post(route('admin.product-category.update', $productCategory->id), $updatedData);

        // Assert: Check if the category was updated and redirect was made
        $response->assertRedirect(route('admin.product-category.index'));
        $response->assertSessionHas('success', 'Category updated successfully');

        // Assert: Check if the data was updated in the database
        $this->assertDatabaseHas('product_categories', [
            'name' => 'Updated Category',
            'slug' => 'updated-category',
            'description' => 'Updated description',
            'sort' => 2,
            'status' => 0,
            'row' => 2,
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
        ]);
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ProductCategory record with status = 1
        $data = ProductCategory::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.product-category.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Category updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('product_categories', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.product-category.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('product_categories', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a ProductCategory record
        $data = ProductCategory::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.product-category.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Category deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('product_categories', [
            'id' => $data->id,
        ]);
    }


}

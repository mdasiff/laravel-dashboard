<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{ProductCategory, Product};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.product.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.product.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.create');
    }

   

    public function test_edit_view_is_rendered_correctly()
    {
        // Create a product and categories
        $product = Product::factory()->create();
        $categories = ProductCategory::factory()->count(3)->create();

        // Simulate an admin user (assuming an admin guard is used)
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a GET request to the edit route
        $response = $this->get(route('admin.product.edit', $product->id));

        // Assert that the response is successful
        $response->assertStatus(200);

        // Assert that the correct view is returned
        $response->assertViewIs('admin.product.edit');

        // Assert that the product and categories are passed to the view
        $response->assertViewHas('sc', $product);
        $response->assertViewHas('categories', $categories);
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a product record with status = 1
        $data = Product::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.product.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Product updated successfully');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('products', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.product.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('products', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_creates_a_new_product_successfully()
    {
        // Create a product category
        $category = ProductCategory::factory()->create();

        // Simulate an admin user (assuming an admin guard is used)
        $admin = \App\Models\Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Prepare a fake image for upload
        Storage::fake('public');
        $image = UploadedFile::fake()->image('product-image.jpg');

        // Send a POST request to the store route
        $response = $this->post(route('admin.product.store'), [
            'name' => 'New Product',
            'category' => $category->id,
            'description' => 'Product description',
            'sort' => 1,
            'status' => 1,
            'meta_tag_title' => 'Product Meta Title',
            'meta_tag_description' => 'Product Meta Description',
            'meta_tag_keywords' => 'product, keywords',
            'image' => $image,
        ]);

        // Assert that the response redirects to the index route
        $response->assertRedirect(route('admin.product.index'));

        // Assert that a success message is present
        $response->assertSessionHas('success', 'Category created successfully');

        // Assert that the product is saved in the database
        $this->assertDatabaseHas('products', [
            'name' => 'New Product',
            'description' => 'Product description',
            'status' => 1,
        ]);

    }

    public function test_updates_a_product_successfully()
    {
        // Create a product and a category
        $category = ProductCategory::factory()->create();
        $product = Product::factory()->create(['product_category_id' => $category->id]);

        // Simulate an admin user
        $admin = \App\Models\Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Prepare a fake image for upload
        Storage::fake('public');
        $image = UploadedFile::fake()->image('product-image.jpg');

        // Send a PUT request to the update route
        $response = $this->post(route('admin.product.update', $product), [
            'name' => 'Updated Product',
            'category' => $category->id,
            'description' => 'Updated product description',
            'sort' => 2,
            'status' => 1,
            'meta_tag_title' => 'Updated Meta Title',
            'meta_tag_description' => 'Updated Meta Description',
            'meta_tag_keywords' => 'updated, keywords',
            'image' => $image,
        ]);

        // Assert that the response redirects to the index route
        $response->assertRedirect(route('admin.product.index'));

        // Assert that a success message is present
        $response->assertSessionHas('success', 'Product updated successfully');

        // Assert that the product is updated in the database
        $this->assertDatabaseHas('products', [
            'name' => 'Updated Product',
            'description' => 'Updated product description',
            'status' => 1,
            'sort' => 2,
        ]);

    }
    
    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a product record
        $data = Product::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.product.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Product deleted successfully');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('products', [
            'id' => $data->id,
        ]);
    }


}

<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Blog, BlogCategory};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class BlogControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_blog_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blogs.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blogs.index');
    }

    
    public function test_displays_the_create_blog_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blogs.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blogs.create');
    }

    
    public function test_creates_a_blog()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Mock the request data
        $requestData = [
            'title' => 'Test Blog Title',
            'category' => 1,
            'meta_tag_title' => 'Test Meta Title',
            'meta_tag_description' => 'Test Meta Description',
            'status' => 1,
            'image_alt' => 'Test Image Alt',
            'sub_title' => 'Test Sub Title',
            'highlight_keywords' => 'Test Keywords',
            'listing_page_description' => 'Test Listing Description',
            'image' => UploadedFile::fake()->image('test-image.jpg')
        ];

        // Perform the post request
        $response = $this->post(route('admin.blogs.store'), $requestData);

        // Assertions
        $response->assertRedirect(route('admin.blogs.index')); // Asserts redirection to the blogs index page
        $response->assertSessionHas('success', 'Blog created successfully.'); // Asserts the session success message

        // Assert that the blog post exists in the database
        $this->assertDatabaseHas('blogs', [
            'title' => 'Test Blog Title',
            'blog_category_id' => 1,
            'meta_tag_title' => 'Test Meta Title',
            'meta_tag_description' => 'Test Meta Description',
            'status' => 1,
            'image_alt' => 'Test Image Alt',
            'sub_title' => 'Test Sub Title',
            'highlight_keywords' => 'Test Keywords',
            'listing_page_description' => 'Test Listing Description',
        ]);
        
    }

    public function test_displays_the_edit_blog_view()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a blog and a blog category
        $blogCategory = BlogCategory::factory()->create(['status' => 1]);
        $blog = Blog::factory()->create(['blog_category_id' => $blogCategory->id]);

        // Perform the GET request to the edit route
        $response = $this->get(route('admin.blogs.edit', $blog->id));

        // Assertions
        $response->assertStatus(200); // Asserts that the response status is 200 (OK)
        $response->assertViewIs('admin.blogs.update'); // Asserts that the correct view is returned
        $response->assertViewHas('blog', $blog); // Asserts that the 'blog' variable is passed to the view
        $response->assertViewHas('categories', function($categories) use ($blogCategory) {
            return $categories->contains($blogCategory);
        }); // Asserts that the 'categories' variable is passed to the view and includes the expected category
    }

    public function test_updates_an_blog()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a blog and a blog category
        $blogCategory = BlogCategory::factory()->create();
        $blog = Blog::factory()->create(['blog_category_id' => $blogCategory->id]);

        // New data to update the blog
        $newData = [
            'title' => 'Updated Blog Title',
            'category' => $blogCategory->id,
            'meta_tag_title' => 'Updated Meta Tag Title',
            'meta_tag_description' => 'Updated Meta Tag Description',
            'status' => 1,
            'sub_title' => 'Updated Sub Title',
            'highlight_keywords' => 'updated,keywords',
            'listing_page_description' => 'Updated listing page description',
            'image' => UploadedFile::fake()->image('test-image.jpg')
        ];

        // Perform the POST request to the update route
        $response = $this->post(route('admin.blogs.update', $blog->id), $newData);

        // Assertions
        $response->assertRedirect(route('admin.blogs.index')); // Asserts that the response is a redirect to the index page
        $response->assertSessionHas('success', 'Blog updated successfully.'); // Asserts that the success message is in the session

        // Assert the blog is updated in the database
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'title' => 'Updated Blog Title',
            'slug' => \Str::slug('Updated Blog Title'), // Slug should be updated as well
            'meta_tag_title' => 'Updated Meta Tag Title',
            'meta_tag_description' => 'Updated Meta Tag Description',
            'status' => 1,
            'sub_title' => 'Updated Sub Title',
            'highlight_keywords' => 'updated,keywords',
            'listing_page_description' => 'Updated listing page description',
        ]);
    }

    public function test_updates_the_blog_status_toggle()
    {
        // Create a blog and a blog post associated with it
        $blog = Blog::factory()->create();

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Perform the status update request (toggle from 1 to 0)
        $response = $this->get(route('admin.blogs.status_update', $blog->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog status updated successfully.'); // Asserts the session success message

        // Assert the status has been toggled in the database
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'status' => 0, // Status should now be inactive
        ]);

        // Toggle status back to 1 (active)
        $response = $this->get(route('admin.blogs.status_update', $blog->id));

        // Assertions for the second toggle
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog status updated successfully.'); // Asserts the session success message

        // Assert the status has been toggled back in the database
        $this->assertDatabaseHas('blogs', [
            'id' => $blog->id,
            'status' => 1, // Status should now be active again
        ]);
    }

    public function test_deletes_a_blog()
    {
       // Create a blog and a blog associated with it
        $blog = Blog::factory()->create();

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Perform the delete request
        $response = $this->get(route('admin.blogs.delete', $blog->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog deleted successfully.'); // Asserts the session success message

        // Assert that the blog no longer exists in the database
        $this->assertDatabaseMissing('blogs', [
            'id' => $blog->id,
        ]);
    }
    
}

<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Models\Blog;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class BlogPostControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_blog_postindex_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $data = Blog::factory()->create();

        $response = $this->get(route('admin.blogpost.index', $data));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-post.index');
    }

    
    public function test_displays_the_create_blog_post_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $data = Blog::factory()->create();
        $response = $this->get(route('admin.blogpost.create', $data));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-post.create');
    }

    
    public function test_creates_a_blog_post()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $title = 'blog cat ' . time();
        $slug = Str::slug($title);

        $data = Blog::factory()->create();

        $response = $this->post(route('admin.blogpost.store', $data), [
            'heading'=>$title,
            'post'=>'data',
            'status'=>1,
            'sort'=>1,
            'image' => UploadedFile::fake()->image('updated_image.jpg'), // Optional image upload
        ]);


        $response->assertRedirect(route('admin.blogpost.index', $data));
        $response->assertSessionHas('success', 'Blog Post created successfully.');

        $this->assertDatabaseHas('blog_posts', [
            'heading'=>$title,
            'post'=>'data',
            'status'=>1,
            'sort'=>1
        ]);
    }

    
    public function test_displays_the_edit_blog_post_view()
    {
        $blog = Blog::factory()->create();
        $post = BlogPost::factory()->create(['blog_id' => $blog->id]);

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blogpost.edit', [$blog->id, $post->id]));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-post.update');
        $response->assertViewHas(['post' => $post, 'blog' => $blog]);
    }

    public function test_updates_an_blog_post()
    {
        // Create a blog and a blog post associated with it
        $blog = Blog::factory()->create();
        $post = BlogPost::factory()->create(['blog_id' => $blog->id]);

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Data to update the blog post
        $data = [
            'heading' => 'Updated Post Title',
            'image_alt' => 'Updated Image Alt Text',
            'post' => 'Updated content of the blog post.',
            'sort' => 2,
            'status' => 0, // Deactivated
            'image' => UploadedFile::fake()->image('updated_image.jpg'), // Optional image upload
        ];

        // Perform the update request
        $response = $this->post(route('admin.blogpost.update', [$blog->id, $post->id]), $data);

        // Assertions
        $response->assertRedirect(route('admin.blogpost.index', $blog->id)); // Asserting the redirection
        $response->assertSessionHas('success', 'Blog Post updated successfully.'); // Asserting the success message in session

        // Asserting that the blog post data was updated in the database
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'heading' => $data['heading'],
            'image_alt' => $data['image_alt'],
            'post' => $data['post'],
            'sort' => $data['sort'],
            'status' => $data['status'],
        ]);
        
    }

    
    public function test_updates_the_blog_post_status_toggle()
    {
        // Create a blog and a blog post associated with it
        $blog = Blog::factory()->create();
        $post = BlogPost::factory()->create(['blog_id' => $blog->id, 'status' => 1]); // Initially active

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Perform the status update request (toggle from 1 to 0)
        $response = $this->get(route('admin.blogpost.status_update', $post->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog Post status updated successfully.'); // Asserts the session success message

        // Assert the status has been toggled in the database
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'status' => 0, // Status should now be inactive
        ]);

        // Toggle status back to 1 (active)
        $response = $this->get(route('admin.blogpost.status_update', $post->id));

        // Assertions for the second toggle
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog Post status updated successfully.'); // Asserts the session success message

        // Assert the status has been toggled back in the database
        $this->assertDatabaseHas('blog_posts', [
            'id' => $post->id,
            'status' => 1, // Status should now be active again
        ]);
    }

   

    
    public function test_deletes_a_blog_post()
    {
       // Create a blog and a blog post associated with it
        $blog = Blog::factory()->create();
        $post = BlogPost::factory()->create(['blog_id' => $blog->id]);

        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Perform the delete request
        $response = $this->get(route('admin.blogpost.delete', $post->id));

        // Assertions
        $response->assertRedirect(); // Asserts redirection back to the previous page
        $response->assertSessionHas('success', 'Blog Post deleted successfully.'); // Asserts the session success message

        // Assert that the blog post no longer exists in the database
        $this->assertDatabaseMissing('blog_posts', [
            'id' => $post->id,
        ]);
    }
}

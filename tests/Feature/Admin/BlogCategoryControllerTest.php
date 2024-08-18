<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class BlogCategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_blog_category_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-category.index');
    }

    
    public function test_displays_the_create_blog_category_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-category.create');
    }

    
    public function test_creates_a_blogcategory()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $title = 'blog cat ' . time();
        $slug = Str::slug($title);

        $response = $this->post(route('admin.blog-category.store'), [
            'title' => $title,
            'slug' => $slug,
            'status' => 1,
            'sort' => 1,
        ]);


        $response->assertRedirect(route('admin.blog-category.index'));
        $response->assertSessionHas('success', 'Blog Category created successfully.');

        $this->assertDatabaseHas('blog_categories', [
            'title' => $title,
            'slug' => $slug,
            'status' => 1,
            'sort' => 1,
        ]);
    }

    
    public function test_displays_the_edit_blog_category_view()
    {
        $data = BlogCategory::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.edit', $data));

        $response->assertStatus(200);
        $response->assertViewIs('admin.blog-category.update');
        $response->assertViewHas('category', $data);
    }

    public function test_updates_an_blogcategory()
    {
        $data = BlogCategory::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $title = 'blog cat ' . time();
        $slug = Str::slug($title);

        $response = $this->post(route('admin.blog-category.update', $data), [
            'title' => $title,
            'slug' => $slug,
            'status' => 1,
            'sort' => 1,
        ]);


        $response->assertRedirect(route('admin.blog-category.index'));
        $response->assertSessionHas('success', 'Blog Category updated successfully.');

        $this->assertDatabaseHas('blog_categories', [
            'id' => $data->id,
            'title' => $title,
            'slug' => $slug,
            'status' => 1,
            'sort' => 1,
        ]);
    }

    
    public function test_updates_the_blog_category_status()
    {
        $data = BlogCategory::factory()->create(['status' => 1]);

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.status_update', $data));

        $response->assertRedirect(route('admin.blog-category.index'));
        $response->assertSessionHas('success', 'Blog Category updated successfully.');

        $this->assertDatabaseHas('blog_categories', [
            'id' => $data->id,
            'status' => 0,
        ]);
    }

    public function test_updates_the_blog_category_status_disable()
    {
        $data = BlogCategory::factory()->create(['status' => 0]);

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.status_update', $data));

        $response->assertRedirect(route('admin.blog-category.index'));
        $response->assertSessionHas('success', 'Blog Category updated successfully.');

        $this->assertDatabaseHas('blog_categories', [
            'id' => $data->id,
            'status' => 1,
        ]);
    }

    
    public function test_deletes_a_blogcategory()
    {
        $category = BlogCategory::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.blog-category.delete', $category));

        $response->assertRedirect(route('admin.blog-category.index'));
        $response->assertSessionHas('success', 'Blog Category delete successfully.');

        $this->assertDatabaseMissing('blog_categories', [
            'id' => $category->id,
        ]);
    }
}

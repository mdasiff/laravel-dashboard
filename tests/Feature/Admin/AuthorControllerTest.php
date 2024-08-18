<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Author;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class AuthorControllerTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_displays_the_author_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.author.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.author.index');
    }

    
    public function test_displays_the_create_author_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.author.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.author.create');
    }

    
    public function test_creates_an_author()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');
        
        $response = $this->post(route('admin.author.store'), [
            'name' => 'John Doe',
            'designation' => 'Author',
            'description' => 'Description of the author',
            'sort' => 1,
            'status' => 1,
            'image' => UploadedFile::fake()->image('author.jpg', 600, 600)
        ]);

        $response->assertRedirect(route('admin.author.index'));
        $response->assertSessionHas('success', 'Author created successfully.');

        $this->assertDatabaseHas('authors', [
            'name' => 'John Doe',
            'designation' => 'Author',
            'description' => 'Description of the author',
            'status' => 1,
            'sort' => 1,
        ]);
    }

    
    public function test_displays_the_edit_author_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $author = Author::factory()->create();

        $response = $this->get(route('admin.author.edit', $author));

        $response->assertStatus(200);
        $response->assertViewIs('admin.author.edit');
        $response->assertViewHas('author', $author);
    }

    
    public function test_updates_an_author()
    {
        $author = Author::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.author.update', $author), [
            'name' => 'Jane Doe',
            'designation' => 'Editor',
            'description' => 'Updated description',
            'sort' => 2,
            'status' => 0,
            'image' => UploadedFile::fake()->image('author_updated.jpg', 600, 600)
        ]);


        $response->assertRedirect(route('admin.author.index'));
        $response->assertSessionHas('success', 'Author updated successfully.');

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'name' => 'Jane Doe',
            'designation' => 'Editor',
            'description' => 'Updated description',
            'status' => 0,
            'sort' => 2,
        ]);
    }

    
    public function test_updates_the_author_status()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $author = Author::factory()->create(['status' => 1]);

        $response = $this->get(route('admin.author.status_update', $author));
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Author status updated successfully.');

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'status' => 0,
        ]);
    }

    public function test_updates_the_author_status_as_disable()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $author = Author::factory()->create(['status' => 0]);

        $response = $this->get(route('admin.author.status_update', $author));
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Author status updated successfully.');

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'status' => 1,
        ]);
    }

    
    public function test_deletes_an_author()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $author = Author::factory()->create();

        $response = $this->get(route('admin.author.delete', $author));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Author deleted successfully.');

        $this->assertDatabaseMissing('authors', [
            'id' => $author->id,
        ]);
    }
}

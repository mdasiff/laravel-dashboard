<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Banner;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class BannerControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_banner_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.index');
    }

    
    public function test_displays_the_create_banner_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.create');
    }

    
    public function test_creates_a_banner()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        Storage::fake('public');

        $response = $this->post(route('admin.banner.store'), [
            'title' => 'New Banner',
            'subtitle' => 'This is a subtitle',
            'link' => 'https://example.com',
            'status' => 1,
            'image_alt' => 'An alt text',
            'cta_text' => 'Click Here',
            'sort' => 1,
            'image' => UploadedFile::fake()->image('banner.jpg', 600, 600),
            'image_mobile' => UploadedFile::fake()->image('banner_mobile.jpg', 300, 300),
        ]);


        $response->assertRedirect(route('admin.banner.index'));
        $response->assertSessionHas('success', 'Banner created successfully.');

        $this->assertDatabaseHas('banners', [
            'title' => 'New Banner',
            'subtitle' => 'This is a subtitle',
            'link' => 'https://example.com',
            'status' => 1,
            'image_alt' => 'An alt text',
            'cta_text' => 'Click Here',
            'sort' => 1,
        ]);
    }

    
    public function test_displays_the_edit_banner_view()
    {
        $banner = Banner::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.edit', $banner));

        $response->assertStatus(200);
        $response->assertViewIs('admin.banner.edit');
        $response->assertViewHas('banner', $banner);
    }

    public function test_updates_an_banner()
    {
        $banner = Banner::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->post(route('admin.banner.update', $banner), [
            'title' => 'New Banner u',
            'subtitle' => 'This is a subtitle u',
            'link' => 'https://example.com',
            'status' => 1,
            'image_alt' => 'An alt text',
            'cta_text' => 'Click Here',
            'sort' => 1,
            'image' => UploadedFile::fake()->image('banner.jpg', 600, 600),
            'image_mobile' => UploadedFile::fake()->image('banner_mobile.jpg', 300, 300),
        ]);


        $response->assertRedirect(route('admin.banner.index'));
        $response->assertSessionHas('success', 'Banner updated successfully');

        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'title' => 'New Banner u',
            'subtitle' => 'This is a subtitle u',
            'link' => 'https://example.com',
            'status' => 1,
            'image_alt' => 'An alt text',
            'cta_text' => 'Click Here',
            'sort' => 1,
        ]);
    }


    
    public function test_updates_the_banner_status()
    {
        $banner = Banner::factory()->create(['status' => 1]);

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.status_update', $banner));

        $response->assertRedirect(route('admin.banner.index'));
        $response->assertSessionHas('success', 'Banner updated successfully');

        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'status' => 0,
        ]);
    }

    public function test_updates_the_banner_status_disable()
    {
        $banner = Banner::factory()->create(['status' => 0]);

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.status_update', $banner));

        $response->assertRedirect(route('admin.banner.index'));
        $response->assertSessionHas('success', 'Banner updated successfully');

        $this->assertDatabaseHas('banners', [
            'id' => $banner->id,
            'status' => 1,
        ]);
    }

    
    public function test_deletes_a_banner()
    {
        $banner = Banner::factory()->create();

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.banner.delete', $banner));

        $response->assertRedirect(route('admin.banner.index'));
        $response->assertSessionHas('success', 'Banner deleted successfully');

        $this->assertDatabaseMissing('banners', [
            'id' => $banner->id,
        ]);
    }
}

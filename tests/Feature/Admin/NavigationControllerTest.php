<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\{Navigation};
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class NavigationControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_displays_the_index_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.navigation.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.navigation.index');
    }

    public function test_displays_the_create_view()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $response = $this->get(route('admin.navigation.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.navigation.create');
    }

    public function test_store_level_1()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Setup
        Storage::fake('public'); // Use a fake storage to avoid actual file system changes

        $response = $this->post(route('admin.navigation.store'), [
            'name' => 'Level 1 Navigation',
            'type' => 'link',
            'file' => UploadedFile::fake()->create('level1.pdf', 100, 'application/pdf'),
            'link' => 'level-1-link',
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'level_main' => 1, // This should be used as parent_id
            'meta_tag_title' => 'Level 1 Title',
            'meta_tag_keywords' => 'level, 1',
            'meta_tag_description' => 'Level 1 description',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Navigation created successfully.');

        // Assert that the navigation item was created
        $this->assertDatabaseHas('navigations', [
            'name' => 'Level 1 Navigation',
            'type' => 'link',
            'file' => \Str::slug('Level 1 Navigation') . '-' . time() . '.pdf',
            'link' => \Str::slug('level-1-link'),
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'parent_id' => 1, // As level is 1, parent_id should be level_main
            'main_menu_id' => 0,
            'meta_tag_title' => 'Level 1 Title',
            'meta_tag_keywords' => 'level, 1',
            'meta_tag_description' => 'Level 1 description',
        ]);
    }

    public function test_store_level_2()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Setup
        Storage::fake('public'); // Use a fake storage to avoid actual file system changes

        $response = $this->post(route('admin.navigation.store'), [
            'name' => 'Level 2 Navigation',
            'type' => 'link',
            'file' => UploadedFile::fake()->create('level2.pdf', 100, 'application/pdf'),
            'link' => 'level-2-link',
            'status' => 1,
            'sort' => 2,
            'level' => 2,
            'level_main' => 1, // This should be used as main_menu_id
            'level_1' => 2, // This should be used as parent_id
            'meta_tag_title' => 'Level 2 Title',
            'meta_tag_keywords' => 'level, 2',
            'meta_tag_description' => 'Level 2 description',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Navigation created successfully.');

        // Assert that the navigation item was created
        $this->assertDatabaseHas('navigations', [
            'name' => 'Level 2 Navigation',
            'type' => 'link',
            'file' => \Str::slug('Level 2 Navigation') . '-' . time() . '.pdf',
            'link' => \Str::slug('level-2-link'),
            'status' => 1,
            'sort' => 2,
            'level' => 2,
            'parent_id' => 2, // As level is 2, parent_id should be level_1
            'main_menu_id' => 1, // As level is 2, main_menu_id should be level_main
            'meta_tag_title' => 'Level 2 Title',
            'meta_tag_keywords' => 'level, 2',
            'meta_tag_description' => 'Level 2 description',
        ]);
    }

    public function test_edit()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a navigation item
        $navigation = Navigation::create([
            'name' => 'Main Navigation',
            'type' => 'link',
            'file' => '',
            'link' => 'main-link',
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'parent_id' => 0,
            'main_menu_id' => 0,
            'meta_tag_title' => 'Main Title',
            'meta_tag_keywords' => 'main, keywords',
            'meta_tag_description' => 'Main description',
        ]);

        // Create other navigation items for the main menu and level 1
        Navigation::create([
            'name' => 'Sub Navigation 1',
            'type' => 'link',
            'file' => '',
            'link' => 'sub-link-1',
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'parent_id' => 0,
            'main_menu_id' => 1,
            'meta_tag_title' => 'Sub Title 1',
            'meta_tag_keywords' => 'sub, keywords',
            'meta_tag_description' => 'Sub description 1',
        ]);

        Navigation::create([
            'name' => 'Sub Navigation 2',
            'type' => 'link',
            'file' => '',
            'link' => 'sub-link-2',
            'status' => 1,
            'sort' => 1,
            'level' => 2,
            'parent_id' => 1,
            'main_menu_id' => 1,
            'meta_tag_title' => 'Sub Title 2',
            'meta_tag_keywords' => 'sub, keywords',
            'meta_tag_description' => 'Sub description 2',
        ]);

        // Perform a GET request to the edit page
        $response = $this->get(route('admin.navigation.edit', $navigation));

        // Assert that the response is OK
        $response->assertStatus(200);

        // Assert that the view has the expected data
        $response->assertViewHas('navigation', $navigation);
        $response->assertViewHas('main_menu_items', Navigation::where('parent_id', 0)->get());
        $response->assertViewHas('level1_menu_items', Navigation::where('parent_id', $navigation->main_menu_id)->get());

        // Assert the view is rendered correctly
        $response->assertViewIs('admin.navigation.update');
    }

    public function test_update_level_1()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Setup
        Storage::fake('public'); // Use a fake storage to avoid actual file system changes

        // Create level 1 navigation item
        $navigation = Navigation::create([
            'name' => 'Original Level 1 Navigation',
            'type' => 'link',
            'file' => '',
            'link' => 'original-level-1-link',
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'parent_id' => 0,
            'main_menu_id' => 0,
            'meta_tag_title' => 'Original Level 1 Title',
            'meta_tag_keywords' => 'level1, keywords',
            'meta_tag_description' => 'Original level 1 description',
        ]);

        $updatedFile = UploadedFile::fake()->create('new-file.pdf');

        // Send POST request to update the navigation
        $response = $this->post(route('admin.navigation.update', $navigation), [
            'name' => 'Updated Level 1 Navigation',
            'type' => 'link',
            'file' => $updatedFile,
            'link' => 'updated-level-1-link',
            'status' => 1,
            'sort' => 2,
            'level' => 1,
            'level_main' => 0, // For level 1, this is usually not used
            'meta_tag_title' => 'Updated Level 1 Title',
            'meta_tag_keywords' => 'updated, keywords',
            'meta_tag_description' => 'Updated level 1 description',
        ]);

        // Assert that the response redirects correctly and has a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Navigation updated successfully.');

        // Assert that the navigation was updated correctly
        $navigation->refresh();
        $this->assertEquals('Updated Level 1 Navigation', $navigation->name);
        $this->assertEquals('updated-level-1-link', $navigation->link);
        $this->assertEquals(1, $navigation->status);
        $this->assertEquals(2, $navigation->sort);
        $this->assertEquals(1, $navigation->level);
        $this->assertEquals(0, $navigation->parent_id);
        $this->assertEquals('Updated Level 1 Title', $navigation->meta_tag_title);
        $this->assertEquals('updated, keywords', $navigation->meta_tag_keywords);
        $this->assertEquals('Updated level 1 description', $navigation->meta_tag_description);

    }

    public function test_update_level_2()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Setup
        Storage::fake('public'); // Use a fake storage to avoid actual file system changes

        // Create level 1 navigation item for reference
        $level1Navigation = Navigation::create([
            'name' => 'Level 1 Navigation',
            'type' => 'link',
            'file' => '',
            'link' => 'level-1-link',
            'status' => 1,
            'sort' => 1,
            'level' => 1,
            'parent_id' => 0,
            'main_menu_id' => 0,
            'meta_tag_title' => 'Level 1 Title',
            'meta_tag_keywords' => 'level1, keywords',
            'meta_tag_description' => 'Level 1 description',
        ]);

        // Create level 2 navigation item
        $navigation = Navigation::create([
            'name' => 'Original Level 2 Navigation',
            'type' => 'link',
            'file' => '',
            'link' => 'original-level-2-link',
            'status' => 1,
            'sort' => 1,
            'level' => 2,
            'parent_id' => $level1Navigation->id,
            'main_menu_id' => $level1Navigation->id,
            'meta_tag_title' => 'Original Level 2 Title',
            'meta_tag_keywords' => 'level2, keywords',
            'meta_tag_description' => 'Original level 2 description',
        ]);

        $updatedFile = UploadedFile::fake()->create('new-file.pdf');

        // Send POST request to update the navigation
        $response = $this->post(route('admin.navigation.update', $navigation), [
            'name' => 'Updated Level 2 Navigation',
            'type' => 'link',
            'file' => $updatedFile,
            'link' => 'updated-level-2-link',
            'status' => 1,
            'sort' => 2,
            'level' => 2,
            'level_main' => $level1Navigation->id, // For level 2, this is the main menu ID
            'level_1' => $level1Navigation->id, // For level 2, this is the parent ID
            'meta_tag_title' => 'Updated Level 2 Title',
            'meta_tag_keywords' => 'updated, keywords',
            'meta_tag_description' => 'Updated level 2 description',
        ]);

        // Assert that the response redirects correctly and has a success message
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Navigation updated successfully.');

        // Assert that the navigation was updated correctly
        $navigation->refresh();
        $this->assertEquals('Updated Level 2 Navigation', $navigation->name);
        $this->assertEquals('updated-level-2-link', $navigation->link);
        $this->assertEquals(1, $navigation->status);
        $this->assertEquals(2, $navigation->sort);
        $this->assertEquals(2, $navigation->level);
        $this->assertEquals($level1Navigation->id, $navigation->parent_id);
        $this->assertEquals($level1Navigation->id, $navigation->main_menu_id);
        $this->assertEquals('Updated Level 2 Title', $navigation->meta_tag_title);
        $this->assertEquals('updated, keywords', $navigation->meta_tag_keywords);
        $this->assertEquals('Updated level 2 description', $navigation->meta_tag_description);

    }


    public function test_get_level_1_list()
    {
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create some test data
        $parentId = 1;
        $level1Items = Navigation::factory()->count(3)->create(['parent_id' => $parentId]);

        // Send a request to the method
        $response = $this->post(route('admin.navigation.get_level_1_list', ['val' => $parentId]));

        // Assert the response status
        $response->assertStatus(200);

        // Extract the response content
        $responseContent = $response->getContent();

        // Assert each level 1 item is returned as an <option> element
        foreach ($level1Items as $item) {
            $this->assertStringContainsString('<option value="'.$item->id.'">'.$item->name.'</option>', $responseContent);
        }
    }

    public function test_status_update()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a navigations record with status = 1
        $data = Navigation::factory()->create([
            'status' => 1,
        ]);

        // Send a POST request to update the status
        $response = $this->get(route('admin.navigation.status_update', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Navigation updated successfully.');

        // Assert the status was toggled in the database
        $this->assertDatabaseHas('navigations', [
            'id' => $data->id,
            'status' => 0, // Status should be toggled to 0
        ]);

        // Toggle the status back to 1
        $response = $this->get(route('admin.navigation.status_update', $data->id));

        // Assert the status was toggled back to 1
        $this->assertDatabaseHas('navigations', [
            'id' => $data->id,
            'status' => 1, // Status should be toggled back to 1
        ]);
    }

    public function test_delete()
    {
        // Create an admin user and authenticate as admin
        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Create a Navigation record
        $data = Navigation::factory()->create();

        // Send a DELETE request to delete the data record
        $response = $this->get(route('admin.navigation.delete', $data->id));

        // Assert the response is a redirect back
        $response->assertRedirect();

        // Assert the success message is in the session
        $response->assertSessionHas('success', 'Navigation deleted successfully.');

        // Assert the record no longer exists in the database
        $this->assertDatabaseMissing('marketplace_categories', [
            'id' => $data->id,
        ]);
    }

}

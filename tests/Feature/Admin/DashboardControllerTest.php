<?php
namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class DashboardControllerTest extends TestCase
{
    
    public function test_countries_index() {

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        // Send a request to the index route
        $response = $this->get(route('admin.dashboard'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.index');

    }


}

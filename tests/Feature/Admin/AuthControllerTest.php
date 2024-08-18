<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_the_login_view()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.auth.login');
    }

    public function test_it_allows_authenticated_admins_to_login()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('password123')
        ]);

        $response = $this->post(route('admin.login.post'), [
            'email' => $admin->email,
            'password' => 'password123'
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated('admin');
    }

    public function test_it_does_not_allow_invalid_credentials_to_login()
    {
        $response = $this->post(route('admin.login.post'), [
            'email' => 'invalid@example.com',
            'password' => 'wrongpassword'
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error', 'Invalid credentials');
        $this->assertGuest('admin');
    }

    public function test_it_logs_out_the_admin_and_redirects()
    {
        $admin = Admin::factory()->create([
            'password' => Hash::make('password123')
        ]);

        Auth::guard('admin')->login($admin);

        $response = $this->post(route('admin.logout'));

        $response->assertRedirect(route('admin.login'));
        $this->assertGuest('admin');
    }
}


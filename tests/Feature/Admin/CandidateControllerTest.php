<?php
namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Candidate;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Str;

class CandidateControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_candidates() {
        // Create some sample candidates

        $admin = Admin::factory()->create();
        $this->actingAs($admin, 'admin');

        $candidates = Candidate::factory()->count(5)->create();

        // Send a request to the candidates route
        $response = $this->get(route('admin.positions.candidates'));

        // Assert the response is OK
        $response->assertStatus(200);

        // Assert that the view is the correct one
        $response->assertViewIs('admin.position.candidates');

        // Assert that the view has the candidates data
        $response->assertViewHas('candidates', function($viewCandidates) use ($candidates) {
            return $viewCandidates->count() === 5 && $viewCandidates->first()->id === $candidates->last()->id;
        });
    }

}

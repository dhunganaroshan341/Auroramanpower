<?php

namespace Tests\Feature;

use App\Http\Requests\JobRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class JobRequestTest extends TestCase
{
    /**
     * Helper to run validation manually using the JobRequest rules
     */
    protected function validate(array $data)
    {
        $request = new JobRequest();

        $validator = Validator::make(
            $data,
            $request->rules(),
            $request->messages()
        );

        return $validator;
    }

    /** @test */
    public function it_passes_with_valid_data()
    {
        $validator = $this->validate([
            'title' => 'Software Engineer',
            'job_code' => 'ENG001',
            'description' => 'Develop and maintain software systems.',
            'requirements' => 'PHP, Laravel, Vue.js',
            'salary' => 50000,
            'our_country_id' => 1,
            'status' => 'Active',
            'openings_mode' => 'total',
            'total_openings' => 2,
        ]);

        $this->assertTrue($validator->passes());
    }

    /** @test */
    public function it_fails_if_title_is_missing()
    {
        $validator = $this->validate([
            'job_code' => 'ENG001',
            'description' => 'Test job',
            'status' => 'Active',
            'openings_mode' => 'total'
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_if_status_is_invalid()
    {
        $validator = $this->validate([
            'title' => 'Backend Developer',
            'job_code' => 'DEV123',
            'description' => 'Some description',
            'status' => 'Pending', // ❌ Invalid
            'openings_mode' => 'total'
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('status', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_if_openings_mode_is_invalid()
    {
        $validator = $this->validate([
            'title' => 'Frontend Developer',
            'job_code' => 'FRONT001',
            'description' => 'Some description',
            'status' => 'Active',
            'openings_mode' => 'unknown', // ❌ Invalid
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('openings_mode', $validator->errors()->toArray());
    }

    /** @test */
    public function it_fails_if_image_is_wrong_type()
    {
        $validator = $this->validate([
            'title' => 'Designer',
            'job_code' => 'DESIGN001',
            'description' => 'Create UI/UX',
            'status' => 'Active',
            'openings_mode' => 'total',
            'image' => 'not-an-image.txt', // ❌ Invalid
        ]);

        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('image', $validator->errors()->toArray());
    }
}

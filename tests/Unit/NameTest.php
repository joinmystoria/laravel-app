<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Name;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NameTest extends TestCase
{
    use RefreshDatabase; // This resets the database after each test

    /** @test */
    public function it_can_create_a_name()
    {
        $name = Name::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $this->assertDatabaseHas('name', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /** @test */
    public function it_can_fetch_all_names()
    {
        Name::factory()->count(3)->create(); // Create 3 fake names

        $this->assertEquals(3, Name::count()); // Check if 3 names exist
    }
}

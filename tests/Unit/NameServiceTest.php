<?php

namespace Tests\Unit;

use App\Models\Name;
use App\Services\NameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class NameServiceTest extends TestCase
{
    use RefreshDatabase; // Ensures DB is fresh for each test

    private $nameService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->nameService = new NameService();
    }

    /** @test */
    public function it_can_fetch_all_names()
    {
        // Create dummy names in the database
        Name::factory()->count(3)->create();

        // Call the service method
        $names = $this->nameService->getAllName();

        // Assert that 3 names are returned
        $this->assertCount(3, $names);
    }

    /** @test */
    public function it_can_create_a_name()
    {
        // Mock name data
        $nameData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        // Call the service method
        $name = $this->nameService->createName($nameData);

        // Assert that the name exists in the database
        $this->assertDatabaseHas('name', $nameData);
    }

    /** @test */
    public function it_can_update_a_name()
    {
        // Create a name record
        $name = Name::factory()->create();

        // New data
        $updatedData = ['first_name' => 'Jane', 'last_name' => 'Smith'];

        // Update via service
        $this->nameService->updateName($name->id, $updatedData);

        // Assert database has updated data
        $this->assertDatabaseHas('name', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_name()
    {
        // Create a name record
        $name = Name::factory()->create();

        // Delete via service
        $this->nameService->deleteName($name->id);

        // Assert name no longer exists
        $this->assertDatabaseMissing('name', ['id' => $name->id]);
    }
}

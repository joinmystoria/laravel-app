<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Name;
use App\Services\NameService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class NameControllerTest extends TestCase
{
    use RefreshDatabase;

    private $nameServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the NameService and bind it to the service container
        $this->nameServiceMock = Mockery::mock(NameService::class);
        $this->app->instance(NameService::class, $this->nameServiceMock);
    }

    /** @test */
    public function it_can_fetch_all_names()
    {
        // Mocked data to return
        $mockedNames = collect([
            new Name(['first_name' => 'John', 'last_name' => 'Doe']),
            new Name(['first_name' => 'Jane', 'last_name' => 'Smith']),
        ]);

        $this->nameServiceMock
            ->shouldReceive('getAllName')
            ->once()
            ->andReturn($mockedNames);

        // Make the request
        $response = $this->get('/api/names');

        // Assertions
        $response->assertStatus(200)
            ->assertJson([
                ['first_name' => 'John', 'last_name' => 'Doe'],
                ['first_name' => 'Jane', 'last_name' => 'Smith'],
            ]);
    }

    /** @test */
    public function it_can_create_a_name()
    {
        $data = ['first_name' => 'John', 'last_name' => 'Doe'];
        $mockedName = new Name($data);
        $mockedName->id = 1;

        $this->nameServiceMock
            ->shouldReceive('createName')
            ->once()
            ->with($data)
            ->andReturn($mockedName);

        $response = $this->post('/api/add', $data);

        $response->assertStatus(201)
            ->assertJson([
                'id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
            ]);
    }

    /** @test */
    public function it_can_update_a_name()
    {

        $name = Name::factory()->create();

        $updatedData = ['first_name' => 'Jane', 'last_name' => 'Smith'];

        $this->nameServiceMock
            ->shouldReceive('updateName')
            ->once()
            ->with($name->id, $updatedData)
            ->andReturn(true);

        $response = $this->put("/api/update/{$name->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Name updated successfully']);
    }

    /** @test */
    public function it_can_delete_a_name()
    {
        $name = Name::factory()->create();

        $this->nameServiceMock
            ->shouldReceive('deleteName')
            ->once()
            ->with($name->id)
            ->andReturn(true);

        $response = $this->delete("/api/delete/{$name->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Name deleted successfully']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

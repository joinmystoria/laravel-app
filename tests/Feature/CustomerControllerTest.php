<?php

namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Services\CustomerService;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    private $customerServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Mock the CustomerService
        $this->customerServiceMock = Mockery::mock(CustomerService::class);
        $this->app->instance(CustomerService::class, $this->customerServiceMock);
    }

    /** @test */
    public function it_can_fetch_all_customers()
    {
        // Arrange: Mock the service response
        $customers = Customer::factory()->count(3)->make(); // Creates fake customers but doesn't save them
        $this->customerServiceMock->shouldReceive('getAllCustomers')
            ->once()
            ->andReturn($customers);

        // Act: Make the API request
        $response = $this->get('/api/customers');

        // Assert: Check response
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_create_a_customer()
    {
        // Arrange: Mock the service response
        $customerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        $this->customerServiceMock->shouldReceive('createCustomer')
            ->once()
            ->with($customerData)
            ->andReturn(new Customer($customerData));

        // Act: Send a POST request
        $response = $this->post('/api/customers', $customerData);

        // Assert: Check response
        $response->assertStatus(201)
                 ->assertJson($customerData);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}

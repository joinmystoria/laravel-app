<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Mockery;

class CustomerServiceTest extends TestCase
{
    use RefreshDatabase; // Ensures DB is fresh for each test

    private $customerService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->customerService = new CustomerService();
    }

    /** @test */
    public function it_can_fetch_all_customers()
    {
        // Create dummy customers in the database
        Customer::factory()->count(3)->create();

        // Call the service method
        $customers = $this->customerService->getAllCustomers();

        // Assert that 3 customers are returned
        $this->assertCount(3, $customers);
    }

    /** @test */
    public function it_can_create_a_customer()
    {
        // Mock customer data
        $customerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];

        // Call the service method
        $customer = $this->customerService->createCustomer($customerData);

        // Assert that the customer exists in the database
        $this->assertDatabaseHas('customers', $customerData);
    }
}

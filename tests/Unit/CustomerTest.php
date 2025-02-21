<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase; // This resets the database after each test

    /** @test */
    public function it_can_create_a_customer()
    {
        $customer = Customer::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $this->assertDatabaseHas('customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);
    }

    /** @test */
    public function it_can_fetch_all_customers()
    {
        Customer::factory()->count(3)->create(); // Create 3 fake customers

        $this->assertEquals(3, Customer::count()); // Check if 3 customers exist
    }
}

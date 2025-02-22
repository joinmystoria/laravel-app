<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Services\CustomerService;

class CustomerController extends Controller {
    
    private $customerService;

    // Inject CustomerService via the constructor
    public function __construct(CustomerService $customerService) {
        $this->customerService = $customerService;
    }

    public function index() {
        return response()->json($this->customerService->getAllCustomers());
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $customer = $this->customerService->createCustomer($validatedData);

        return response()->json($customer, 201);
    }
}

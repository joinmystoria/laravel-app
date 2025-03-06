<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\NameService;

class NameController extends Controller {
    
    private $nameService;

    // Inject NameService via the constructor
    public function __construct(NameService $nameService) {
        $this->nameService = $nameService;
    }

    // Get All Names
    public function index() {
        return response()->json($this->nameService->getAllName());
    }

    // Add Names
    public function store(Request $request) {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);
    
        $name = $this->nameService->createName($validatedData);
    
        // Manually structure the response to place `id` at the top
        return response()->json([
            'id' => $name->id,
            'first_name' => $name->first_name,
            'last_name' => $name->last_name,
        ], 201);
    }
    
    // Update Names
    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $updatedName = $this->nameService->updateName($id, $validatedData);

        if (!$updatedName) {
            return response()->json(['message' => 'Name not found'], 404);
        }

        return response()->json(['message' => 'Name updated successfully']);
    }

    // Delete Names
    public function destroy($id) {
        $deleted = $this->nameService->deleteName($id);

        if (!$deleted) {
            return response()->json(['message' => 'Name not found'], 404);
        }

        return response()->json(['message' => 'Name deleted successfully']);
    }
}

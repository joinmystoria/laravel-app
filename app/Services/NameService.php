<?php

namespace App\Services;

use App\Models\Name;

class NameService {

    // Fetches all names, in desc order
    public function getAllName() {
        return Name::orderBy('id', 'desc')->get(); 
    }

    // Save names to database
    public function createName(array $data) {
        return Name::create($data);  
    }

    // Update an existing name
    public function updateName($id, array $data) {
        $name = Name::find($id);
        
        if (!$name) {
            return false;
        }

        $name->update($data);
        return true;
    }

    // Delete a name from database
    public function deleteName($id) {
        $name = Name::find($id);
        
        if (!$name) {
            return false;
        }

        $name->delete();
        return true;
    }
}

<?php
// app/Http/Controllers/ItemController.php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    // Get all items
    public function index(){
        // Get all items from the database
        $items = Item::all();

        // Return the list of items as a JSON response
        return response()->json(
     $items
        );
    }

    // Get a specific item by its ID
    public function show($id)
    {
        // Find the item by its ID
        $item = Item::find($id);

        // Check if the item exists
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!'
            ], 404);  // 404 is the HTTP status code for Not Found
        }

        // Return the item as a JSON response
        return response()->json([
            'success' => true,
            'data' => $item
        ]);
    }

    // Update an existing item
    public function update(Request $request, $id)
    {
        // Validate the updated data
        $validated = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string',
        ]);

        // Find the item by its ID
        $item = Item::find($id);

        // Check if the item exists
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!'
            ], 404);  // 404 if item not found
        }

        // Update the item with the validated data
        $item->update($validated);

        // Return a JSON response with the updated item
        return response()->json([
            'success' => true,
            'message' => 'Item updated successfully!',
            'data' => $item
        ]);
    }

    // Delete an item
    public function destroy($id)
    {
        // Find the item by its ID
        $item = Item::find($id);

        // Check if the item exists
        if (!$item) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found!'
            ], 404);  // 404 if item not found
        }

        // Delete the item
        $item->delete();

        // Return a JSON response indicating the item was deleted
        return response()->json([
            'success' => true,
            'message' => 'Item deleted successfully!'
        ]);
    }

    // Store a new item
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'category' => 'required|string',
        ]);

        // Create the new item
        $item = Item::create($validated);

        // Return a JSON response with the created item and success message
        return response()->json([
            'success' => true,
            'message' => 'Item added successfully!',
            'data' => $item
        ], 201);  // 201 is the HTTP status code for resource creation
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = FAQ::all();
        return response()->json($faqs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(array $data)
    {
        return response()->json(['message' => 'This endpoint is not used in APIs.'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, array $data)
    {
        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        $faq = FAQ::create($data);

        return response()->json(['message' => 'FAQ created successfully.', 'data' => $faq], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = FAQ::find($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ not found.'], 404);
        }

        return response()->json($faq);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json(['message' => 'This endpoint is not used in APIs.'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, array $data)
    {
        $faq = FAQ::find($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ not found.'], 404);
        }

        $data = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:1000',
        ]);

        $faq->update($data);

        return response()->json(['message' => 'FAQ updated successfully.', 'data' => $faq]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = FAQ::find($id);

        if (!$faq) {
            return response()->json(['message' => 'FAQ not found.'], 404);
        }

        $faq->delete();

        return response()->json(['message' => 'FAQ deleted successfully.']);
    }
}

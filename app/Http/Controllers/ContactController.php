<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // List all contacts with sorting and searching functionality
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name'); // Default sort by name
        $sortOrder = $request->input('sort_order', 'asc'); // Default sort order asc

        $contacts = Contact::query()
            ->where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->orderBy($sortBy, $sortOrder)
            ->get();

        return view('contacts.index', compact('contacts', 'search', 'sortBy', 'sortOrder'));
    }

    // Show the form to create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store a new contact
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Contact::create($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show a specific contact
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    // Show the form to edit an existing contact
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Update a contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:contacts,email,{$id}",
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $contact->update($validatedData);

        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Delete a contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}

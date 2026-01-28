<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityCompanyLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecurityCompanyLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyLinks = SecurityCompanyLink::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.security-company-links.index', compact('companyLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.security-company-links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('company-links', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        SecurityCompanyLink::create($validated);

        return redirect()->route('admin.security-company-links.index')
            ->with('success', 'Security company link created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SecurityCompanyLink $securityCompanyLink)
    {
        return view('admin.security-company-links.show', compact('securityCompanyLink'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecurityCompanyLink $securityCompanyLink)
    {
        return view('admin.security-company-links.edit', compact('securityCompanyLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SecurityCompanyLink $securityCompanyLink)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($securityCompanyLink->logo) {
                Storage::disk('public')->delete($securityCompanyLink->logo);
            }
            $validated['logo'] = $request->file('logo')->store('company-links', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $securityCompanyLink->update($validated);

        return redirect()->route('admin.security-company-links.index')
            ->with('success', 'Security company link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecurityCompanyLink $securityCompanyLink)
    {
        // Delete logo if exists
        if ($securityCompanyLink->logo) {
            Storage::disk('public')->delete($securityCompanyLink->logo);
        }

        $securityCompanyLink->delete();

        return redirect()->route('admin.security-company-links.index')
            ->with('success', 'Security company link deleted successfully.');
    }
}

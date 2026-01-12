<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::first();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,ico,svg|max:512',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
        ]);

        $settings = SiteSetting::first();

        // Handle file uploads
        if ($request->hasFile('header_logo')) {
            if ($settings && $settings->header_logo) {
                Storage::disk('public')->delete($settings->header_logo);
            }
            $validated['header_logo'] = $request->file('header_logo')->store('settings', 'public');
        }

        if ($request->hasFile('footer_logo')) {
            if ($settings && $settings->footer_logo) {
                Storage::disk('public')->delete($settings->footer_logo);
            }
            $validated['footer_logo'] = $request->file('footer_logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($settings && $settings->favicon) {
                Storage::disk('public')->delete($settings->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        // Remove null values to avoid overwriting with null
        $validated = array_filter($validated, function($value) {
            return $value !== null;
        });

        if ($settings) {
            $settings->update($validated);
        } else {
            SiteSetting::create($validated);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}

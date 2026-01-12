<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $customer = Auth::guard('customer')->user();
        return view('customer.profile', compact('customer'));
    }

    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Update basic info
        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'] ?? null;
        $customer->address = $validated['address'] ?? null;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if exists
            if ($customer->profile_picture && Storage::disk('public')->exists($customer->profile_picture)) {
                Storage::disk('public')->delete($customer->profile_picture);
            }

            $path = $request->file('profile_picture')->store('customer-profiles', 'public');
            $customer->profile_picture = $path;
        }

        // Update password if provided
        if ($request->filled('password')) {
            $customer->password = Hash::make($validated['password']);
        }

        $customer->save();

        return redirect()->route('customer.profile')->with('success', 'Profile updated successfully!');
    }
}

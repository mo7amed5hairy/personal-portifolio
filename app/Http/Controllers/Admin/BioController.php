<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;

class BioController extends Controller
{
    public function edit()
    {
        $bio = Bio::first() ?? new Bio();
        return view('admin.bio.form', compact('bio'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'about_me' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'cv_path' => 'nullable|string',
            'social_links' => 'nullable|string',
        ]);

        // Convert social links string to array
        if (!empty($validated['social_links'])) {
            $links = [];
            foreach (explode(',', $validated['social_links']) as $link) {
                $parts = explode(':', $link, 2);
                if (count($parts) === 2) {
                    $links[trim($parts[0])] = trim($parts[1]);
                }
            }
            $validated['social_links'] = $links;
        } else {
            $validated['social_links'] = [];
        }

        $bio = Bio::first();
        if ($bio) {
            $bio->update($validated);
        } else {
            Bio::create($validated);
        }

        return redirect()->route('admin.bio.edit')->with('success', 'Bio updated successfully!');
    }
}

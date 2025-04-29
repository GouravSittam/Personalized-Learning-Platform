<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSection;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $section = $course->sections()->create($validated);

        return redirect()->back()->with('success', 'Section created successfully.');
    }

    public function update(Request $request, CourseSection $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $section->update($validated);

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    public function destroy(CourseSection $section)
    {
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $validated = $request->validate([
            'sections' => 'required|array',
            'sections.*.id' => 'required|exists:course_sections,id',
            'sections.*.order' => 'required|integer|min:0',
        ]);

        foreach ($validated['sections'] as $sectionData) {
            CourseSection::where('id', $sectionData['id'])
                ->update(['order' => $sectionData['order']]);
        }

        return response()->json(['message' => 'Sections reordered successfully']);
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SectionRequest;
use App\Models\Section;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::latest()->paginate();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(SectionRequest $request)
    {
        Section::create($request->validated());
        return redirect()->route('admin.sections.index');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }

    public function update(SectionRequest $request, Section $section)
    {
        $section->update($request->validated());
        return redirect()->route('admin.sections.index');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('admin.sections.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CaseStudyRequest;
use App\Models\CaseStudy;

class CaseStudyController extends Controller
{
    public function index()
    {
        $caseStudies = CaseStudy::latest()->paginate();
        return view('admin.case-studies.index', compact('caseStudies'));
    }

    public function create()
    {
        return view('admin.case-studies.create');
    }

    public function store(CaseStudyRequest $request)
    {
        CaseStudy::create($request->validated());
        return redirect()->route('admin.case-studies.index');
    }

    public function edit(CaseStudy $caseStudy)
    {
        return view('admin.case-studies.edit', compact('caseStudy'));
    }

    public function update(CaseStudyRequest $request, CaseStudy $caseStudy)
    {
        $caseStudy->update($request->validated());
        return redirect()->route('admin.case-studies.index');
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->delete();
        return redirect()->route('admin.case-studies.index');
    }
}

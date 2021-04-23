<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;

class SiptadahController extends Controller
{
    public function index()
    {
        return view('siptadah.index');
    }

    public function create()
    {
        return view('siptadah.create');
    }

    public function show($id)
    {
        $request_id = $id;
        $request = ModelsRequest::findOrFail($id);
        if (auth()->user()->id !== 1) {
            if ($request->user_id !== auth()->user()->id || auth()->user()->cannot('Input Siptadah') || auth()->user()->hasRole(['admin','Admin'])) {
                abort(403);
            }
        }
        return view('siptadah.show', compact(['request_id']));
    }

    public function edit($id)
    {
        $request = ModelsRequest::findOrFail($id);
        $evidence = ModelsRequest::findOrFail($id)->evidence_lists;
        if (auth()->user()->id !== 1) {
            if ($request->user_id !== auth()->user()->id || auth()->user()->cannot('Edit Siptadah')) {
                abort(403);
            }
        }
        return view('siptadah.edit', compact(['request', 'evidence']));
    }
}

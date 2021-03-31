<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RequestController extends Controller
{
    public function index()
    {
        return view('user.request.index');
    }

    public function create()
    {
        return view('user.request.create');
    }

    public function show($id)
    {
        $request_id = $id;
        $request = ModelsRequest::findOrFail($id);
        if (auth()->user()->id !== 1) {
            if ($request->user_id !== auth()->user()->id || auth()->user()->cannot('Edit Permohonan')) {
                abort(403);
            }
        }
        return view('user.request.show', compact(['request_id']));
    }

    public function edit($id)
    {
        $request = ModelsRequest::findOrFail($id);
        $evidence = ModelsRequest::findOrFail($id)->evidence_lists;
        if (auth()->user()->id !== 1) {
            if ($request->user_id !== auth()->user()->id || auth()->user()->cannot('Edit Permohonan')) {
                abort(403);
            }
        }
        return view('user.request.edit', compact(['request', 'evidence']));
    }
}

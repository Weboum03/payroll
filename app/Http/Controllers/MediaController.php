<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function store(Request $request) {
        $user = User::find(1);

        $user->addMedia($request->file('image'))->toMediaCollection('images');

        return response()->json(true);
    }

    public function show(Request $request) {
        $user = User::find(1);

        $mediaItems = $user->getMedia('*');

        return response()->json($mediaItems);
    }

    public function destroy(Request $request) {
        $user = User::find(1);

        $user->clearMediaCollection('*');

        return response()->json(true);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function store(Request $request) {

        $temporaryPath = $request->file('image')->store('tmp');

        return response()->json([
            'status' => true,
            'message' => 'File uploaded temporarily',
            'temporary_path' => $temporaryPath,
        ]);

        $user = User::find(1);

        $user->uploadMedia('user_profile_picture', $temporaryPath);

        return response()->json(true);

        if (!Storage::exists($temporaryPath)) {
            return response()->json(['message' => 'Temporary file not found'], 404);
        }

        // Get the file from the temporary path
        $temporaryFile = Storage::path($temporaryPath);

        // Move the file to the user's media collection
        $user->addMedia($temporaryFile)->toMediaCollection('user_profile_picture');

        // Delete the temporary file
        Storage::delete($temporaryPath);

        return response()->json(true);
    }

    public function show(Request $request) {
        $user = User::find(1);

        $mediaItems = $user->media;

        $mediaItems = $user->getMedia('*');

        return response()->json($mediaItems);
    }

    public function destroy(Request $request) {
        $user = User::find(1);

        $user->clearMediaCollection('*');

        return response()->json(true);
    }
}

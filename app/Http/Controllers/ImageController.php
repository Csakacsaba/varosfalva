<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class ImageController extends Controller
{
    public function show($type)
    {
        $image = Image::where('type', $type)->first();
        if (is_null($image)){
            abort(404);
        }


        $images = Media::where('collection_name', $type)
            ->paginate(20);


        return view('gallery.show',[
            'image' => $image,
            'images' => $images
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|array',
            'image.*' => 'image',
            'type' => 'required|string',
            'description' => 'max:255'
        ]);

        $image_type = Str::of($request->type)->slug('-');
        $images = $request->file('image');

        foreach ($images as $image_file) {
            $image = Image::where('type', $image_type)->first();

            if (is_null($image)) {
                $image = Image::create([
                    'type' => $image_type,
                    'description' => $request->input('description')
                ]);
            }

            $image->addMedia($image_file)
                ->withCustomProperties(['description' => $request->input('description')])
                ->toMediaCollection($image_type);
        }

        return back()->with('success', 'Images uploaded successfully.');
    }



}

<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

//ez a kontroller felelos a kepek megjeleniteseert es feltolteseert
class ImageController extends Controller
{
//    a kepek megjeleniteseert felelos metodus
    public function show($type)
    {
//        keresi a kepet az adott kategoria szerint
        $image = Image::where('type', $type)->first();
        if (is_null($image)){
//            ha nem talal akkor 404errort ad vissza
            abort(404);
        }

//      egy oldalon 20 kep fog megjelenni
        $images = Media::where('collection_name', $type)
            ->paginate(20);

//      a 'gallery.show' nezetet adja vissza a kepek listajaval
        return view('gallery.show',[
            'image' => $image,
            'images' => $images
        ]);
    }

//    kepek feltolteesert felelos metodus
    public function upload(Request $request)
    {
//        validacio
        $request->validate([
            'image' => 'required|array',
            'image.*' => 'image',
            'type' => 'required|string',
            'description' => 'max:255'
        ]);
//      a tipus slug formatumuva alakitasa
        $image_type = Str::of($request->type)->slug('-');
        $images = $request->file('image');
//      ellenorzi, hogy letezik e mar az adott tipusu kep, es ha nem akkor letrehozza azt, ha igen akkor ahhoz a tipushoz rendeli hozza
         foreach ($images as $image_file) {
            $image = Image::where('type', $image_type)->first();

            if (is_null($image)) {
                $image = Image::create([
                    'type' => $image_type,
                    'description' => $request->input('description')
                ]);
            }
//          feltolti a kepet a fajlok koze
            $image->addMedia($image_file)
                ->withCustomProperties(['description' => $request->input('description')])
                ->toMediaCollection($image_type);
        }

        return back()->with('success', 'Images uploaded successfully.');
    }
}

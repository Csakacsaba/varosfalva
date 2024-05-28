<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
//    visszaadja a hirek oldalt a felhasznalonak
    public function create()
    {
//        lekerdezi a hireket csokkeno sorrendben a letrehozasi ido szerint
        return view('contents.news_user', [
            'news' => News::orderBy('created_at', 'desc')->get()
        ]);
    }
//    letrehozza a hirek oldalt az admin reszere
    public function news_admin()
    {
//     lekerdezi a hireket csokkeno sorrendben a letrehozasi ido szerint
        return view('admin.news_admin', [
            'news' => News::orderBy('created_at', 'desc')->get()
        ]);
    }
//    elmenti az uj letrehozott hirt az adatbazisba
    public function news_store(Request $request)
    {
//        validalja a keres adatait
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'required|image|max:5048',
        ]);

//  egyeni feltoltesi utvonalat kellett megadjak mert a szerveren nem mukodott maskepp
//        feltolti a kepeket a 'pubic_uploads' mappaba es azon belul a 'news' mappaba
        $imagePath = $request->file('image')->store('/news', ['disk'=> 'public_uploads']);

//        letrehoz egy uj news objektumot es beallitja a mezoit
        $news = new News();
        $news->title = $validatedData['title'];
        $news->content = $validatedData['content'];
        $news->author = $validatedData['author'];
        $news->image = $imagePath;
//        elmenti az uj hirt az adatbazisba
        $news->save();
//      visszair'nyitja a felhasznalot az elozo oldalra
        return redirect()->back()->with('success', 'A hírcikk sikeresen feltöltve');
    }


//hirek torlese
    public function news_delete(News $new)
    {
//        torli a keresben kapott hirt
        $new->delete();
//        visszairanyit az eredeti oldalra
        return redirect()->back();
    }
}

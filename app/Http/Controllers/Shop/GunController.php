<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Gun;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class GunController extends Controller
{
    public function index()
    {
        $guns = Gun::all();

        return $guns;
    }

    public function store(Request $request)
    {
        $name = $request->name;
        $description = $request->description;

        $photo = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->photo));
        $type = explode(';', $request->photo)[0];
        $type = explode('/', $type)[1];
        $fileName = Str::random(35) . "." . $type;
        Storage::put("public/$fileName", $photo);
       
        $gun = Gun::create([
           'name' => $name,
           'description' => $description,
           'photo' => $fileName
        ]);

       return $gun;
    }

    public function show(Gun $gun)
    {
        return $gun;
    }

    public function update(Request $request, Gun $gun)
    {
        $gun->name = $request->name;
        $gun->description = $request->description;

        $gun->save();

        return $gun;
    }

    public function destroy(Gun $gun)
    {
        $gun->delete();

        return 'Bagulho deletado vey';
    }
}

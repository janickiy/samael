<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ImageGallery;

class ImageGalleryController extends Controller
{
    /**
     * Listing Of images gallery
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $images = ImageGallery::where('id_model', $id)->get();
        return view('admin.catalog.image-gallery.index', compact('images'))->with('id_model', $id);
    }

    /**
     * Upload image function
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'id_model' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input['image'] = str_random(20) . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path() . PATH_CARS, $input['image']);
        $input['title'] = trim($request->title);
        $input['id_model'] = $request->id_model;

        ImageGallery::create($input);

        return back()->with('success', 'Изображение загруженно');
    }

    /**
     * Remove Image function
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ImageGallery::find($id)->delete();
        return back()->with('success', 'Изображение удалено.');
    }
}

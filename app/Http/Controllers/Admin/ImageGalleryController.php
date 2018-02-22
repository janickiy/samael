<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CatalogModel;
use App\ImageGallery;

class ImageGalleryController extends Controller
{
    /**
     * Listing Of images gallery
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $mark = CatalogModel::select(['catalog_marks.id', 'catalog_marks.name as mark', 'catalog_models.name as model'])->join('catalog_marks', 'catalog_models.id_car_mark', '=', 'catalog_marks.id')->where('catalog_models.id',$id)->first()->toArray();
        $images = ImageGallery::where('id_model', $id)->get();
        return view('admin.catalog.image-gallery.index', compact('images', 'mark'))->with('id_model', $id);
    }

    /**
     * Upload image function
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('image');

        foreach ($file as $f) {
            $input = [];

            $input['image'] = str_random(20) . '.' . $f->getClientOriginalExtension();
            $f->move(public_path() . PATH_CARS, $input['image']);
            $input['title'] = $f->getClientOriginalName();
            $input['id_model'] = $request->input('id_model');

            ImageGallery::create($input);
        }

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

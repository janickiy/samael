<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ImagesRequest;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as ImageInt;
use App\Image;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        return view('admin.images.index', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.images.create_edit');
    }

    /**
     * @param ImagesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $small_path = public_path() . PATH_SMALL_IMAGES;
        $big_path = public_path() . PATH_BIG_IMAGES;
        $file = $request->file('image');
        $category = $request->input('category');

        foreach ($file as $f) {
            $filename = str_random(20) . '.' . $f->getClientOriginalExtension() ? : 'png';
            $imageName = $f->getClientOriginalName();
            $img = ImageInt::make($f);

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($small_path . $filename);


            $img->resize(1000, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($big_path . $filename);


            Image::create(['title' => $imageName, 'img' => $filename, 'category' => $category]);
        }

        return redirect('admin/images')->with('success', 'Фотографии добавлены');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->index();
    }

    /**
     * @param Request $request
     * @param Image $image
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, Image $image)
    {
        if ($request->ajax()) {
            $small_image = public_path() . PATH_SMALL_IMAGES . $image->img;
            $big_image = public_path() . PATH_BIG_IMAGES . $image->im;

            if (file_exists($small_image)) @unlink($small_image);
            if (file_exists($big_image)) @unlink($big_image);

            $image->delete();
            return response()->json(['success' => 'Фото успешно удалено']);
        } else {
            return 'Вы не можете продолжить операцию удаления';
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserReviewsRequest;
use App\Http\Controllers\Controller;
use App\UserReview;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reviews.index');
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
     * @param UserReview $userReview
     * @return $this
     */
    public function edit(UserReview $review)
    {
       /// dd($review);
        return view('admin.reviews.create_edit')->with(compact('review'));
    }

    /**
     * @param UserReviewsRequest $request
     * @param UserReview $userReview
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserReviewsRequest $request, UserReview $userReview)
    {
        $userReview->author = trim($request->input('author'));
        $userReview->email = trim($request->input('email'));
        $userReview->message = trim($request->input('message'));
        $userReview->published = $request->input('published');
        $userReview->save();

        return redirect('admin/reviews')->with('success', ' Отзыв обнавлен');
    }

    /**
     * @param Request $request
     * @param UserReview $userReview
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function destroy(Request $request, UserReview $userReview)
    {
        if ($request->ajax()) {
            $userReview->delete();
            return response()->json(['success' => 'Отзыв удален']);
        } else {
            return 'Ошибка веб приложения! Действия не были выполнены.';
        }
    }
}

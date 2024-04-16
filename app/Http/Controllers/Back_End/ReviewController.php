<?php

namespace App\Http\Controllers\Back_End;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function review_index(){
        $reviews = Review::get();

        return view('Back_End.pages.reviews.review_index',compact('reviews'));
    }
}

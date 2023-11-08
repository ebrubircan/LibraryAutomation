<?php

namespace App\Http\Controllers;

use App\Services\ReviewsService;
use Illuminate\Http\Request;


class ReviewsController extends Controller
{
    protected $reviewsService;

    public function __construct(ReviewsService $bookReviewsService)
    {
        $this->reviewsService = $bookReviewsService;
    }

    public function addReview(Request $request)
    {
        $reviewsID = $request->input('ID');
        $bookID = $request->input('BookID');
        $studentID = $request->input('StudentID');
        $review = $request->input('ReviewText');
        $rating = $request->input('Rating');

        $this->reviewsService->addReview($reviewsID, $bookID, $studentID, $review, $rating);

        return response()->json(['message' => 'Review added successfully'], 200);
    }

    public function generateRatingStars($rating)
    {
        $stars = str_repeat('★', $rating);
        return $stars;
    }

    public function getStudentReviews()
    {
        $studentReviews = $this->reviewsService->getStudentReviews();
        foreach ($studentReviews as $review) {
            $review->Rating = $this->generateRatingStars($review->Rating);
        }
        return response()->json($studentReviews);
    }
}

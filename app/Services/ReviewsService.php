<?php

namespace App\Services;

use App\Repositories\ReviewsRepository;

class ReviewsService
{
    protected $reviewsRepository;

    public function __construct(ReviewsRepository $bookReviewsRepository)
    {
        $this->reviewsRepository = $bookReviewsRepository;
    }

    public function addReview($reviewsID, $bookID, $studentID, $review, $rating)
    {
        return $this->reviewsRepository->createReview($reviewsID, $bookID, $studentID, $review, $rating);
    }

    public function getStudentReviews() {
        return $this->reviewsRepository->getStudentReviews();
    }
}

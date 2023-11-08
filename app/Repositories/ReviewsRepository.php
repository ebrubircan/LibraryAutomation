<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ReviewsRepository
{
    public function createReview($reviewsID, $bookID, $studentID, $review, $rating)
    {
        return DB::table('reviews')->insert([
            'ID' => $reviewsID,
            'StudentID' => $studentID,
            'BookID' => $bookID,
            'ReviewText' => $review,
            'Rating' => $rating,
        ]);
    }

    public function getStudentReviews() {
        return DB::table('student')
            ->join('reviews', 'student.ID', '=', 'reviews.StudentID')
            ->join('books', 'reviews.BookID', '=', 'books.ID')
            ->select('student.Name', 'student.Surname', 'books.BookName', 'reviews.ReviewText', 'reviews.Rating')
            ->get();
    }
}

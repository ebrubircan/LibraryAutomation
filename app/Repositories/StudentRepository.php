<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;
class  StudentRepository
{

    public function createToken($studentID, $token)
    {
        DB::table('personal_access_tokens')->insert([
            'tokenable_id' => $studentID,
            'tokenable_type' => 'App\Models\Student',
            'token' => hash('sha256', $token),
            'abilities' => '[]',
            'created_at' => now(),
            'updated_at' => now(),
            'name' => 'authToken'
        ]);
        return $token;
    }
}



   /* public function refreshToken($studentID,$token)
    {
        try {
            $newToken = $this->generateToken($token);
            return $this->createNewToken($newToken, $studentID);
        } catch (Exception $e) {
            $errorMessage = 'Error while refreshing token: ' . $e->getMessage();
            error_log($errorMessage);
            return response()->json(['error' => $errorMessage], 500);
        }
    }
    public function getUserProfile($studentId)
    {
        try {
            $student = DB::table('student')->where('StudentID', $studentId)->first();

            if (!$student) {
                return ['error' => 'Student not found'];
            }

            return [
                'student_id' => $student->StudentID,
                'name' => $student->Name,
                'email' => $student->Email,
                'surname' => $student->Surname
            ];

        } catch (Exception $e) {
            Log::error('Error while logging in user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'code' => 500,
                'type' => 'Failed to log in user',
                'data' => []
            ]);
        }
    }

    public function logoutUser($studentId)
    {
        try {
            Auth::logout();
            DB::table('personal_access_tokens')->where('tokenable_id', $studentId)->update(['token' => null]);
            return ['message' => 'User successfully logged out'];
        } catch (Exception $e) {
            Log::error('Error while logging in user: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'code' => 500,
                'type' => 'Failed to log in user',
                'data' => []
            ]);
        }
    }*/


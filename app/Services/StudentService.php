<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class StudentService
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function register(array $data)
    {
        $user = User::create([
            'StudentID' => $data['StudentID'],
            'Name' => $data['Name'],
            'Surname' => $data['Surname'],
            'Email' => $data['Email'],
            'Password' => Hash::make($data['Password']),
        ]);

        return $user;
    }

    public function login($request)
    {
        $request->validate([
            'Email' => 'required|email',
            'Password' => 'required|string',
        ]);

        $credentials = $request->only('Email', 'Password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $token = $this->studentRepository->createToken($user, 'authToken');

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }




















   /* public function refreshToken($token)
    {
        return $this->studentRepository->refreshToken($token);
    }
    public function getUserProfile($studentId)
    {
        return $this->studentRepository->getUserProfile($studentId);
    }
    public function logoutUser($studentId)
    {
        return $this->studentRepository->logoutUser($studentId);
    }*/
}

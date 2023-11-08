<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Validation\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    protected $studentService;
    protected $studentRepository;

    public function __construct(StudentService $studentService, StudentRepository $studentRepository)
    {
        $this->studentService = $studentService;
        $this->studentRepository = $studentRepository;
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'StudentID' => 'required|string|max:255',
            'Name' => 'required|string|max:255',
            'Surname' => 'required|string|max:255',
            'Email' => 'required|string|email|max:255|unique:student',
            'Password' => 'required|string|min:4',
        ]);


        $user = $this->studentService->register($validatedData);

        $token = JWTAuth::fromSubject($user);

        $this->studentRepository->createToken($user->id, $token);

        return response()->json(['token' => $token], 200);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}




    /*if (!Auth::attempt($request->only('email', 'password'))) {
        return response([
            'message' => 'Invalid credentials!'
        ], Response::HTTP_UNAUTHORIZED);
    }

    $user = Auth::user();
    $token = $user->createToken('token')->plainTextToken;
    $this->studentRepository->saveToken($user->id, $token);

    $cookie = cookie('jwt', $token, 60 * 24); // 1 day

    return response([
        'message' => $token
    ])->withCookie($cookie);
}*/











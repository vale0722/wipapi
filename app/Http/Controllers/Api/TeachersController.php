<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherRequest;
use App\Http\Resources\Api\TeachersResource;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $grades = Teacher::all();

        return TeachersResource::collection($grades);
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = new User($data);
        $user->save();
        $teacher = new Teacher(['group_id' => $data['group_id'], 'user_id' => $user->id]);
        $teacher->save();

        return response()->json(
            [
                'status' => [
                    'status' => 200,
                    'message' => 'Profesor creado exitosamente',
                ],
            ]
        );
    }

    public function show(Teacher $teacher): TeachersResource
    {
        return TeachersResource::make($teacher);
    }

    public function update(TeacherRequest $request, Teacher $teacher)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $teacher->user->update($data);

        $teacher->update(['group_id' => $data['group_id'], 'user_id' => $teacher->user->id]);

        return response()->json(
            [
                'status' => [
                    'status' => 200,
                    'message' => 'Profesor actualzado exitosamente',
                ],
            ]
        );
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return response()->json(
            [
                'status' => [
                    'status' => 200,
                    'message' => 'Profesor eliminado exitosamente',
                ],
            ]
        );
    }
}

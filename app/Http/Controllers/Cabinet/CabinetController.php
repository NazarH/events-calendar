<?php

namespace App\Http\Controllers\Cabinet;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UpdateRequest;

class CabinetController extends Controller
{
    public function index()
    {
        return view('cabinet.index', [
            'user' => User::findOrFail(Auth::user()->id)
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if (!$data['password']) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('home');
    }
}

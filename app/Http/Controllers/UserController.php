<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->data);

        $user = User::create([
            'rut' => $data->rut,
            'names' => $data->names,
            'father_surname' => $data->father_surname,
            'mother_surname' => $data->mother_surname,
            'email' => $data->email,
            'date_birth'=> $data->date_birth, 
            'password' => Hash::make($data->password),
        ]);

        if ($request->picture) {
            $picture = $this->upload($request->picture);
            $user->picture = 'img/' . $picture;
            $user->save();
        }

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = json_decode($request->data);

        $user->rut = $data->rut;
        $user->names = $data->names;
        $user->father_surname = $data->father_surname;
        $user->mother_surname = $data->mother_surname;
        $user->email = $data->email;
        $user->date_birth = $data->date_birth;

        if (isset($data->password)) {
            $user->password = Hash::make($data->password);
        }

        if ($request->picture) {
            $picture = $this->upload($request->picture);
            $user->picture = 'img/' . $picture;
        }

        $user->save();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return $user->delete();
    }

    /**
     * Upload profile picture in storage.
     *
     * @param  $picture
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function upload($picture)
    {
        return Storage::disk('public_uploads')->put('pictures', $picture);
    }


}

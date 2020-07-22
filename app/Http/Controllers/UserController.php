<?php

namespace App\Http\Controllers;

use App\Http\Requests\RutRequest;
use App\Http\Requests\RutUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
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
     * @param  \App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {     
        $user = User::create([
            'rut' => $request->rut,
            'names' => $request->names,
            'father_surname' => $request->father_surname,
            'mother_surname' => $request->mother_surname??'',
            'email' => $request->email,
            'date_birth'=> $request->date_birth, 
            'password' => Hash::make($request->password),
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
     * @param  \App\Http\Requests\UserUpdateRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->rut = $request->rut;
        $user->names = $request->names;
        $user->father_surname = $request->father_surname;
        $user->mother_surname = $request->mother_surname??'';
        $user->email = $request->email;
        $user->date_birth = $request->date_birth;

        if (isset($request->password)) {
            $user->password = Hash::make($request->password);
        }

        if ($request->picture) {
            $picture = $this->upload($request->picture, $user->picture);
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
        if ($user->picture) {
            $this->deletePicture($user->picture);
        }
        return $user->delete();
    }

    /**
     * Upload profile picture in storage.
     *
     * @param  $picture
     * @param  $oldPicture
     * @return \Illuminate\Http\Response
     */
    public function upload($picture, $oldPicture = null)
    {
        if ($oldPicture) {
            $this->deletePicture($oldPicture);
        }

        return Storage::disk('public_uploads')->put('pictures', $picture);
    }

    /**
     * Delete profile picture from storage.
     *
     * @param  $picture
     */
    public function deletePicture($picture)
    {
        $picture = str_replace('img/', '', $picture);
        Storage::disk('public_uploads')->delete($picture);
    }

    /**
     * Validate rut for store.
     *
     * @param  App\Http\Requests\RutRequest $request
     * @return \Illuminate\Http\Response
     */
    public function validateStoreRut(RutRequest $request)
    {
        return true;
    }

    /**
     * Validate rut for update.
     *
     * @param  App\Http\Requests\RutUpdateRequest $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function validateUpdateRut(RutUpdateRequest $request, User $user)
    {
        return true;
    }

}

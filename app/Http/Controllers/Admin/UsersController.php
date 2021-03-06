<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Droid;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\Datatables\Facades\Datatables;
use App\DataTables\UsersDataTable;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'permission:View Members', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(UsersDataTable $dataTable)
     {
         return $dataTable->render('admin.users.index');
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

        if (auth()->user()->cannot('Edit Members')) {
            abort(403);
        }
        $roles = Role::all();
        return view('admin.users.edit')->with([
          'user' => $user,
          'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if (auth()->user()->can('Edit Permissions')) {
            $user->syncRoles($request->roles);
        } else {
            abort(403);
        }

        if (auth()->user()->cannot('Edit Members')) {
            abort(403);
        }
        $request->validate([
            'forename' => 'required',
            'surname' => 'required'
        ]);

      try {
          $user->update($request->except('roles'));
          toastr()->success('User updated successfully');
      } catch (\Illuminate\Database\QueryException $exception) {
          toastr()->error('Failed to update User');
      }

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function upload(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.png';

        file_put_contents($file, $image_base64);

        return response()->json(['success'=>'success']);
    }

}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        return view('users.index');

    }

    public function userList()
    {
        return datatables()->of(User::latest()->get())->addIndexColumn()
            ->addColumn('action', function ($users) {
                $button = '<div class="btn-group btn-group-xs">';
                $button .= '<a href="admin/users/' . $users->id . '/edit" class="btn btn-primary btn-xs"><i class="fa fa-edit fa-fw"></i></a>';
                $button .= '<button type="button" name="deleteButton" id="' . $users->id . '" class="btn btn-danger btn-xs deleteButton"><i class="fas fa-trash-alt"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *
     * @param \App\Models\User $user
     *
     */
    public function history(User $user)
    {
        return view('users.history', [
            'user' => $user
        ]);

    }

    /**
     *
     * @param \App\Models\User $user
     *
     */
    public function historyList(User $user)
    {

        $userPayments = $user->payments;
        return DataTables::of($userPayments)->addIndexColumn()->make(true);

    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('users.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     */
    public function store(StoreUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->route('users.index')->with(['success' => 'Created Successfully']);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     *
     */
    public function edit(User $user)
    {
        return view('users.edit', [
                'user' => $user
            ]
        );

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     *
     */
    public function update(UpdateUserRequest $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->balance = $request->balance;
        if ($request->password) {

            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect()->route('users.edit', $user->id)->with(['success' => 'Updated Successfully']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     *
     */
    public function destroy(User $user)
    {
        $user->payments()->delete();
        $user->delete();
        return "success";

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()
            ->when(!empty($request->from_date), function ($query) use ($request) {
                $query->whereDate('created_at', '>=', $request->from_date);
            })->when(!empty($request->to_date), function ($query) use ($request) {
                $query->whereDate('created_at', '<=', $request->to_date);
            });

            return DataTables::of($users)
                ->addIndexColumn()
                ->editColumn('created_at', function ($user) {
                    return $user->created_at->format('Y-m-d H:i:s');
                })
                ->toJson();
        }

        return view('users.index');
    }

    public function list()
    {
        $users = User::paginate();

        return view('users.list', compact('users'));
    }
}

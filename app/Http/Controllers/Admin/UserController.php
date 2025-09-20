<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Log;
use Throwable;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('users.index', [
            'users' => User::paginate(10)
        ]);
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();

            return back()->with('success', 'User deleted successfully.');
        } catch (Throwable $th) {
            Log::error($th);

            return back()->with('error', 'Something went wrong.');
        }

    }

    public function toggleStatus(User $user, $status)
    {
        try {
            $user->is_disabled = $status == 'disable';
            $user->save();

            if ($user->is_disabled) {
                return back()->with('success', 'User disabled successfully.');
            }

            return back()->with('success', 'User enabled successfully.');
        } catch (Throwable $th) {
            Log::error($th);

            return back()->with('error', 'Something went wrong.');
        }
    }
}

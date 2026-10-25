<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Секретный маршрут для создания первого админа
    public function setup()
    {
        if (User::where('is_admin', true)->exists()) {
            abort(404);
        }
        return view('admin.setup');
    }

    public function createAdmin(Request $request)
    {
        if (User::where('is_admin', true)->exists()) {
            abort(404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'secret_password' => 'required',
        ]);

        if ($request->secret_password !== env('ADMIN_SETUP_PASSWORD')) {
            return back()->withErrors(['secret_password' => 'Неверный секретный пароль.']);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true,
        ]);

        return redirect()->route('login')->with('success', 'Администратор создан. Войдите в систему.');
    }

    // Главная страница админки
    public function index()
    {
        $pendingPhotos = Photo::where('is_approved', false)->with('user', 'album')->latest()->get();
        $reports = Report::with('photo', 'user')->latest()->get();
        $users = User::where('is_admin', false)->latest()->get();

        return view('admin.index', compact('pendingPhotos', 'reports', 'users'));
    }

    public function approve($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->update(['is_approved' => true]);
        return back()->with('success', 'Фото одобрено.');
    }

    public function reject($id)
    {
        $photo = Photo::findOrFail($id);
        $photo->delete();
        return back()->with('success', 'Фото отклонено и удалено.');
    }

    public function blockUser($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_blocked' => !$user->is_blocked]);
        return back()->with('success', 'Статус блокировки изменён.');
    }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'Vă rugăm să vă autentificați pentru a accesa profilul.');
        }
        return view('profile.show', compact('user'));
    }
    public function update(Request $request)
    {
        $user = Auth::guard('web')->user();
        if (!$user) {
            return redirect()->route('auth.login')->with('error', 'Vă rugăm să vă autentificați pentru a accesa profilul.');
        }
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        if ($request->filled('password')) {
            if (!$request->filled('current_password')) {
                throw ValidationException::withMessages([
                    'current_password' => ['Parola curentă este obligatorie pentru schimbarea parolei.'],
                ]);
            }
            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => ['Parola curentă este incorectă.'],
                ]);
            }
        }
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
        ];
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
        DB::table('users')->where('id', $user->id)->update($updateData);
        $message = $request->filled('password') ? 
            'Profilul și parola au fost actualizate cu succes!' : 
            'Profilul a fost actualizat cu succes!';
        return redirect()->route('profile')->with('success', $message);
    }
}
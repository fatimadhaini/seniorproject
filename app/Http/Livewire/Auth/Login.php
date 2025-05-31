<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me = false;

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required',
    ];
    protected $listeners = ['setEmail', 'setPassword'];
    public function mount()
    {
        if (auth()->check()) {
            $user = auth()->user();

            return match ($user->role_id) {
                1 => redirect()->route('dashboard'),
                2 => redirect()->route('teacherdash.dashboard'),
                3 => redirect()->route('studentdash.dashboard'),
                4 => redirect()->route('parentdash.dashboard'),
                default => abort(403),
            };
        }
    }


    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = Auth::user();

            // ❗ Check if the user is a teacher and their account is inactive
            if ($user->role_id == 2 && $user->teacher && $user->teacher->status == 0) {
                Auth::logout();
                session()->flash('error', 'Your account is not active. Please contact the admin.');
                return redirect()->route('login');
            }

            // ✅ Role-based redirect
            return match ($user->role_id) {
                1 => redirect()->route('dashboard'),
                2 => redirect()->route('teacherdash.dashboard'),
                3 => redirect()->route('studentdash.dashboard'),
                4 => redirect()->route('parentdash.dashboard'),
                default => abort(403, 'Unknown role'),
            };
        } else {
            $this->dispatch('login-failed');
        }
    }


    public function render()
    {
        return view('livewire.auth.login');
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}



namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'nim'      => ['required', 'string', 'max:20', 'unique:mahasiswas,nim'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                'ends_with:@student.polije.ac.id',
                'unique:users,email'
            ],
            'jurusan'  => ['required', 'string', 'max:100'],
            'prodi'    => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'digits:4', 'integer'],  // ← TAMBAHKAN INI
            'no_hp'    => ['required', 'string', 'max:15'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'agree'    => ['accepted'],
        ], [
            'email.ends_with' => 'Gunakan email resmi Polije (@student.polije.ac.id)',
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'mahasiswa',
        ]);

        // ← TAMBAHKAN INI
        dd([
            'user_id'  => $user->id,
            'nim'      => $validated['nim'],
            'jurusan'  => $validated['jurusan'],
            'prodi'    => $validated['prodi'],
            'no_hp'    => $validated['no_hp'],
            'angkatan' => $validated['angkatan'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat!');
    }
}

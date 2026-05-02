namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function __construct()
    {
        // Memastikan hanya user yang sudah login yang bisa akses
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        // Logika simpan data...
    }
}
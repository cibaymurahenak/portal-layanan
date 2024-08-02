<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Display the login form
    public function showLoginForm()
    {
        $pageTitle = 'LOGIN';
        return view('auth.login', ['pageTitle' => $pageTitle]);
    }

    // Handle the login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $response = Http::withOptions(['verify'=> false])
        ->post('https://bkd.blitarkota.go.id:2024/api/login', [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        Log::info('Login response:', $response->json());

        if ($response->successful()) {
            $token = $response['token'];
            session(['api_token' => $token]);
            return redirect()->route('login-second');
        }

        return back()->withErrors(['login' => 'Email atau password salah']);
    }

    // Get token for SSO
    private function get_token()
    {
        $response = Http::WithOptions(['verify' => false])
        ->post('https://bkd.blitarkota.go.id:2024/api/login', [
            'email' => 'MagangTelkomUniversity@gmail.com',
            'password' => 'Magang2024',
        ]);

        $res = $response->json();
        return $res['token'] ?? null;
    }

    // Display the second login form
    public function showSecondLoginForm()
    {
        $token = $this->get_token();
        return view('auth.login-second', ['token' => $token]);
    }

    public function showSecondLoginFormx(){
        echo "TEST";
        // return view('coba');
    }

    public function secondLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'captcha' => 'required|captcha'
        ], [
            'captcha.captcha' => 'Captcha yang dimasukkan salah. Silakan coba lagi.'
        ]);

        $token = $this->get_token();
        $response = Http::withOptions(['verify' => false])
            ->withToken($token)
            ->post('https://bkd.blitarkota.go.id:2024/api/sso', [
                'username' => $request->username,
                'password' => $request->password,
                'token' => $token
            ]);

        Log::info('Second login response:', $response->json());
        $data = $response->json();

        if (isset($data['data'])) {
            if ($data['data']['login'] == true) {
                session([
                    'sso_data' => $data['data'],
                    'jenis_akses' => $data['data']['jenis_akses'],
                    'username' => $request->username
                ]);

                // Fetch the profile photo and store it in the session
                $nip = $data['data']['nip'];
                $profileResponse = Http::withOptions(['verify' => false])
                    ->withToken($token)
                    ->get("https://bkd.blitarkota.go.id:2024/api/profil-pegawai/{$nip}");

                if ($profileResponse->successful()) {
                    $profileData = $profileResponse->json();
                    session(['profile_photo' => $profileData['foto']]);
                    Log::info('Profile Data:', $profileData);
                }

                return redirect()->route('dashboard')->with('success', $data['data']['message']);
            } else {
                return redirect()->back()->withErrors(['secondlogin' => $data['data']['message']]);
            }
        }

        return redirect()->back()->withErrors(['secondlogin' => 'Invalid response from SSO service.']);
    }



    // Display the dashboard
    public function dashboard()
    {
        $profilePhoto = session('profile_photo');
        $ssoData = session('sso_data');
        return view('dashboard', [
            'ssoData' => $ssoData,
            'profilePhoto' => $profilePhoto
        ]);
    }


//serarch aplikasi
    public function search(Request $request)
    {
        $ssoData = session('sso_data');
        $searchTerm = $request->input('search');
        $filteredApps = [];

        if (!empty($searchTerm)) {
            foreach ($ssoData['app'] as $app) {
                if (stripos($app['app_name'], $searchTerm) !== false) {
                    $filteredApps[] = $app;
                }
            }
        } else {
            $filteredApps = $ssoData['app'];
        }

        return view('dashboard', ['ssoData' => $ssoData, 'filteredApps' => $filteredApps]);
    }

    // Handle logout
    public function logout()
    {
        $apiToken = $this->get_token();
        Session::flush();
        session(['api_token' => $apiToken]);

        return redirect()->route('login-second');
    }

//profile user
    public function profile()
    {
        $ssoData = session('sso_data');
        $token = $this->get_token();
        $nip = session('username');

        $response = Http::withOptions(['verify'=>false])
        ->withToken($token)->get("https://bkd.blitarkota.go.id:2024/api/profil-pegawai/{$nip}");

        if ($response->successful()) {
            $profileData = $response->json();
            session([
                'profile' => $profileData['foto'],
            ]);
            return view('profile', ['profileData' => $profileData]);
        }
        return redirect()->back()->withErrors(['profile' => 'Failed to fetch profile data.']);
    }

//pegawai
    public function pegawai()
    {
        $ssoData = session('sso_data');
        return view('pegawai', ['ssoData' => $ssoData]);
    }

    public function coba()
    {
        $ssoData = session('sso_data');
        $token = $this->get_token();
        $nip = session('username');

        $response = Http::withToken($token)->get("https://bkd.blitarkota.go.id:2024/api/profil-pegawai/{$nip}");

        if ($response->successful()) {
            $profileData = $response->json();
            return view('profile', ['profileData' => $profileData]);
        }
        return redirect()->back()->withErrors(['profile' => 'Failed to fetch profile data.']);
    }

    //search
    public function searchPegawai(Request $request)
    {
        $searchTerm = $request->input('search');
        $token = $this->get_token();

        $response = Http::withOptions(['verify'=>false])
        ->withToken($token)->post('https://bkd.blitarkota.go.id:2024/api/cari-pegawai', [
            'token' => $token,
            'cari_pegawai' => $searchTerm,
        ]);

        if ($response->successful()) {
            $pegawaiData = $response->json()['data'];
            return response()->json(['data' => $pegawaiData]);
        }

        return response()->json(['error' => 'Failed to fetch search results'], 500);
    }

    public function getProfile($nip)
    {
        $ssoData = session('sso_data');
        $token = $this->get_token();

        $response = Http::withOptions(['verify'=>false])
        ->withToken($token)->get("https://bkd.blitarkota.go.id:2024/api/profil-pegawai/{$nip}");

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to fetch profile data'], 500);
    }

    //menyesuaikan halaman reset password
    public function showChangePasswordForm()
    {
        $jenis_akses = session('jenis_akses');

        // Jika jenis_akses adalah OPD atau PTT, arahkan ke view untuk reset password lokal
        if ($jenis_akses == 'OPD' || $jenis_akses == 'PTT') {
            return view('auth.change-password');
        }

        // Jika jenis_akses bukan OPD atau PTT, arahkan langsung ke halaman reset password BKN
        return redirect('https://myasn.bkn.go.id/reset-password');
    }

    // function reset password di halaman change-password
    public function changePassword(Request $request)
    {
        $token = session('api_token');
        $jenis_akses = session('jenis_akses');
        $username = session('username');

        $response = Http::withOptions(['verify'=>false])
        ->withToken($token)->post('https://bkd.blitarkota.go.id:2024/api/ubah-password', [
            'token' => $token,
            'password_lama' => $request->password_lama,
            'password_baru' => $request->password_baru,
            'password_baru_konfirmasi' => $request->password_baru_konfirmasi,
            'jenis_akses' => $jenis_akses,
            'username' => $username,
        ]);

        $responseJson = $response->json();

        // Periksa apakah respons berhasil atau tidak
        if ($response->successful()) {
            // Jika status dari API adalah 1 (sukses)
            if ($responseJson['status'] == 1) {
                session()->flash('success', $responseJson['message']);
                return redirect()->route('dashboard');
            } else {
                // Jika status dari API adalah 0 (gagal)
                session()->flash('error', $responseJson['message']);
                return redirect()->back();
            }
        } else {
            // Jika respons dari API tidak berhasil (misalnya, koneksi error atau API tidak tersedia)
            session()->flash('error', 'Gagal merubah password.');
            return redirect()->back();
        }
    }

    public function editProfile(){
        return view ('Auth.edit-profile');
    }

}

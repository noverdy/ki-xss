<?php

namespace App\Http\Controllers;

use App\Models\User;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'nim' => 'required',
            'password' => 'required'
        ]);

        $cl = new Client();
        $cl->setServerParameter('HTTP_USER_AGENT', 'Notes App - Praktikum Keamanan Informasi');

        $cr = $cl->request('GET', 'https://siam.ub.ac.id/');
        $form = $cr->selectButton('Masuk')->form();
        $cr = $cl->submit($form, array('username' => $credentials['nim'], 'password' => $credentials['password']));

        $cek = $cr->filter('small.error-code')->each(function ($result) {
            return $result->text();
        });

        if (isset($cek[0])) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'login' => 'NIM atau Password salah.'
                ]);
        }

        $data = $cr->filter('div[class="bio-info"] > div')->each(function ($result) {
            return $result->text();
        });

        $user_data = [
            'nim' => $data[0],
            'name' => $data[1],
        ];

        $user = User::where('nim', $user_data['nim'])->first();

        if (is_null($user)) {
            $user = User::create($user_data);
        }

        Auth::login($user);
        return redirect()->route('index');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}

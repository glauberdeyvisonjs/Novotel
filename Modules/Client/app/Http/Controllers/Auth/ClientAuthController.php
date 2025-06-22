<?php

namespace Modules\Client\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Client\Classes\Auth\ClientAuthService;

class ClientAuthController extends Controller
{
    private ClientAuthService $service;

    public function __construct(ClientAuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @return Factory|View|Application
     */
    public function showLoginForm(): Factory|Application|View
    {
        return view('client.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        try {
            return $this->service->login($request);
        } catch (Exception) {
            return back()->withErrors([
                'email' => 'Erro inesperado ao tentar fazer login. Por favor, tente novamente.',
            ]);
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        try {
            return $this->service->logout($request);
        } catch (Exception) {
            return back()->withErrors([
                'error' => 'Erro inesperado ao tentar fazer logout. Por favor, tente novamente.',
            ]);
        }
    }
}

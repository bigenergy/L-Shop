<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Frontend\Auth;

use App\Handlers\Frontend\Auth\ServersHandler;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Auth;
use App\Services\Auth\AccessMode;
use App\Services\Response\JsonResponse;
use App\Services\Response\Status;
use App\Services\Settings\Settings;
use function App\auth_middleware;

/**
 * Class SelectServerController
 * Handles requests related to select server page.
 */
class SelectServerController extends Controller
{
    public function __construct()
    {
        $this->middleware(auth_middleware(Auth::ANY));
    }

    /**
     * Returns the data needed to render the select server page.
     *
     * @param ServersHandler $handler
     * @param Settings       $settings
     *
     * @return JsonResponse
     */
    public function render(ServersHandler $handler, Settings $settings)
    {
        return new JsonResponse(Status::SUCCESS, array_merge($handler->servers()->jsonSerialize(), [
            'allowLogin' => $settings->get('auth.access_mode')->getValue() === AccessMode::ANY ||
                $settings->get('auth.access_mode')->getValue() === AccessMode::AUTH
        ]));
    }
}

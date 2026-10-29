<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ProfileController
 * Handles the user profile page.
 *
 * For now the content is static, it will be loaded from the database later.
 *
 * @package App\Controllers
 */
class ProfileController extends BaseController
{
    /**
     * Displays the profile page of a user.
     *
     * @return Response The response object containing the rendered HTML for the profile page.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }
}

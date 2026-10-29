<?php

namespace App\Controllers;

use Framework\Core\BaseController;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ForumController
 * Handles the forum pages (categories, topics).
 *
 * For now the content is static, it will be loaded from the database later.
 *
 * @package App\Controllers
 */
class ForumController extends BaseController
{
    /**
     * Displays the forum category page with its subcategories and topics.
     *
     * @return Response The response object containing the rendered HTML for the forum page.
     */
    public function index(Request $request): Response
    {
        return $this->html();
    }
}

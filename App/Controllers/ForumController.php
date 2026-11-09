<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class ForumController
 * Handles the forum pages (categories, topics).
 *
 * Topics are loaded from the database, the rest of the content is still static.
 *
 * @package App\Controllers
 */
class ForumController extends BaseController
{
    /**
     * Displays the forum category page with its subcategories and topics.
     *
     * @return Response The response object containing the rendered HTML for the forum page.
     * @throws HttpException
     */
    public function index(Request $request): Response
    {
        // Nacitanie tem z DB, najnovsie hore. Vytvorene s pomocou AI (Claude).
        try {
            $topics = Topic::getAll(null, [], 'createdAt DESC');
        } catch (Exception $e) {
            throw new HttpException(500, "DB Chyba: " . $e->getMessage());
        }
        return $this->html(compact('topics'));
    }

    /**
     * Displays the detail of one topic with its posts.
     *
     * @return Response The response object containing the rendered HTML for the topic page.
     * @throws HttpException
     */
    public function topic(Request $request): Response
    {
        // Nacitanie jednej temy podla id z URL. Vytvorene s pomocou AI (Claude).
        $id = (int)$request->value('id');
        $topic = Topic::getOne($id);

        if (is_null($topic)) {
            throw new HttpException(404);
        }

        // Odpovede patriace k tejto teme, najstarsie hore
        try {
            $posts = Post::getAll('`topic_id` = ?', [$topic->getId()], 'createdAt ASC');
        } catch (Exception $e) {
            throw new HttpException(500, "DB Chyba: " . $e->getMessage());
        }
        return $this->html(compact('topic', 'posts'));
    }
}

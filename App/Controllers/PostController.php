<?php

// Vytvorene s pomocou AI (Claude).

namespace App\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class PostController
 * Manages posts (replies in topics). The posts are shown on the topic page in ForumController.
 *
 * @package App\Controllers
 */
class PostController extends BaseController
{
    /**
     * Only logged-in users can reply. Others are redirected to the login page.
     *
     * @param Request $request
     * @param string $action
     * @return bool
     */
    public function authorize(Request $request, string $action): bool
    {
        return $this->user->isLoggedIn();
    }

    /**
     * The framework requires an index action in every controller. The posts are on the topic pages,
     * so it only redirects to the forum.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->redirect($this->url('forum.index'));
    }

    /**
     * Saves a new reply from the form on the topic page and goes back to the topic.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        $post = new Post();
        $post->setCreatedAt(date('Y-m-d H:i:s'));
        $post->setAuthor($this->user->getName());

        // (string) zmeni null na prazdny text, (int) zmeni text, ktory nie je cislo, na 0
        $post->setText(trim((string)$request->value('text')));
        $post->setTopicId((int)$request->value('topic_id'));

        $formErrors = $this->formErrors($post);
        if (count($formErrors) > 0) {
            // Formular sa zobrazi znova aj s chybami a s tym, co pouzivatel uz napisal
            $topics = Topic::getAll(null, [], 'title ASC');
            return $this->html(compact('post', 'topics', 'formErrors'), 'add');
        }

        try {
            $post->save();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
        // Spat na temu, #odpoved-... posunie stranku rovno na novu odpoved
        return $this->redirect($this->url('forum.topic', ['id' => $post->getTopicId()]) . '#odpoved-' . $post->getId());
    }

    /**
     * Checks the values of the post before saving.
     *
     * @param Post $post
     * @return array List of error messages, empty if everything is OK.
     * @throws Exception
     */
    private function formErrors(Post $post): array
    {
        $errors = [];
        // mb_strlen pocita znaky, nie bajty (dolezite pre slovenske znaky ako č, ž, ô)
        if ($post->getText() == "") {
            $errors[] = "Pole Text odpovede musí byť vyplnené!";
        } elseif (mb_strlen($post->getText()) < 5 || mb_strlen($post->getText()) > 5000) {
            $errors[] = "Text odpovede musí mať 5 až 5000 znakov!";
        }
        // Odpoved musi patrit k teme, ktora naozaj existuje
        if (Topic::getOne($post->getTopicId()) == null) {
            $errors[] = "Vybraná téma neexistuje!";
        }
        return $errors;
    }
}

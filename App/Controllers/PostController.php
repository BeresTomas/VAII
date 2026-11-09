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
     * Any logged-in user can reply, but only the author or the admin can edit or delete a reply.
     * Users who are not logged in are redirected to the login page, others get the error 403.
     *
     * @param Request $request
     * @param string $action
     * @return bool
     * @throws Exception
     */
    public function authorize(Request $request, string $action): bool
    {
        switch ($action) {
            case 'edit':
                return $this->canManage($request);
            case 'save':
                // Ulozenie upravenej odpovede (ma id) moze len autor alebo admin, novu odpoved (bez id) kazdy prihlaseny
                $id = (int)$request->value('id');
                if ($id > 0) {
                    return $this->canManage($request);
                }
                return $this->user->isLoggedIn();
            default:
                return $this->user->isLoggedIn();
        }
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
     * Shows the form filled with the data of an existing reply, including the topic it belongs to.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function edit(Request $request): Response
    {
        $id = (int)$request->value('id');
        $post = Post::getOne($id);

        if (is_null($post)) {
            throw new HttpException(404);
        }
        // Vsetky temy pre vyber vo formulari - odpoved sa da presunut do inej temy
        $topics = Topic::getAll(null, [], 'title ASC');
        return $this->html(compact('post', 'topics'));
    }

    /**
     * Saves a reply (a new one from the topic page or an edited one) and goes back to its topic.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        // Ak formular poslal id, upravujeme existujucu odpoved, inak vytvarame novu
        $id = (int)$request->value('id');

        if ($id > 0) {
            $post = Post::getOne($id);
            if (is_null($post)) {
                throw new HttpException(404);
            }
        } else {
            $post = new Post();
            // Datum a autor sa nastavia len pri novej odpovedi, pri uprave zostanu povodne
            $post->setCreatedAt(date('Y-m-d H:i:s'));
            $post->setAuthor($this->user->getName());
        }

        // (string) zmeni null na prazdny text, (int) zmeni text, ktory nie je cislo, na 0
        $post->setText(trim((string)$request->value('text')));
        $post->setTopicId((int)$request->value('topic_id'));

        $formErrors = $this->formErrors($post);
        if (count($formErrors) > 0) {
            // Formular sa zobrazi znova aj s chybami a s tym, co pouzivatel uz napisal
            $topics = Topic::getAll(null, [], 'title ASC');
            return $this->html(compact('post', 'topics', 'formErrors'), ($id > 0) ? 'edit' : 'add');
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
     * Checks if the logged-in user can edit and delete the reply with the id from the request:
     * the admin can manage every reply, other users only their own.
     *
     * @param Request $request
     * @return bool
     * @throws Exception
     */
    private function canManage(Request $request): bool
    {
        if (!$this->user->isLoggedIn()) {
            return false;
        }
        $post = Post::getOne((int)$request->value('id'));
        if (is_null($post)) {
            return false;
        }
        // Roly zatial nemame, admin je testovaci ucet s menom Admin
        if ($this->user->getName() == 'Admin') {
            return true;
        }
        return $post->getAuthor() == $this->user->getName();
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

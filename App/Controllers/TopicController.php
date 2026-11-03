<?php

// Vytvorene s pomocou AI (Claude).

namespace App\Controllers;

use App\Models\Topic;
use Exception;
use Framework\Core\BaseController;
use Framework\Http\HttpException;
use Framework\Http\Request;
use Framework\Http\Responses\Response;

/**
 * Class TopicController
 * Manages forum topics: adding, editing and deleting. Browsing topics is in ForumController.
 *
 * @package App\Controllers
 */
class TopicController extends BaseController
{
    /**
     * A new topic can be added by any logged-in user, but only the author or the admin can edit or delete it.
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
            case 'delete':
                return $this->canManage($request);
            case 'save':
                // Ulozenie upravenej temy (ma id) moze len autor alebo admin, novu temu (bez id) kazdy prihlaseny
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
     * The framework requires an index action in every controller. The list of topics is on the forum page,
     * so it only redirects there.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->redirect($this->url('forum.index'));
    }

    /**
     * Shows the empty form for a new topic.
     *
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response
    {
        return $this->html();
    }

    /**
     * Shows the form filled with the data of an existing topic.
     *
     * @param Request $request
     * @return Response
     * @throws HttpException
     */
    public function edit(Request $request): Response
    {
        $id = (int)$request->value('id');
        $topic = Topic::getOne($id);

        if (is_null($topic)) {
            throw new HttpException(404);
        }
        return $this->html(compact('topic'));
    }

    /**
     * Saves the topic from the form into the database (a new one or an edited one).
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function save(Request $request): Response
    {
        // Ak formular poslal id, upravujeme existujucu temu, inak vytvarame novu
        $id = (int)$request->value('id');

        if ($id > 0) {
            $topic = Topic::getOne($id);
            if (is_null($topic)) {
                throw new HttpException(404);
            }
        } else {
            $topic = new Topic();
            // Datum zalozenia a autor sa nastavia len pri novej teme, pri uprave zostanu povodne
            $topic->setCreatedAt(date('Y-m-d H:i:s'));
            $topic->setAuthor($this->user->getName());
        }

        // (string) zmeni null na prazdny text, trim odstrani medzery na zaciatku a konci
        $topic->setTitle(trim((string)$request->value('title')));
        $topic->setText(trim((string)$request->value('text')));

        $formErrors = $this->formErrors($topic);
        if (count($formErrors) > 0) {
            // Formular sa zobrazi znova aj s chybami a s tym, co pouzivatel uz napisal
            return $this->html(compact('topic', 'formErrors'), ($id > 0) ? 'edit' : 'add');
        }

        try {
            $topic->save();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
        return $this->redirect($this->url('forum.topic', ['id' => $topic->getId()]));
    }

    /**
     * Deletes the topic and goes back to the forum page.
     *
     * @param Request $request
     * @return Response
     * @throws HttpException
     */
    public function delete(Request $request): Response
    {
        $id = (int)$request->value('id');
        $topic = Topic::getOne($id);

        if (is_null($topic)) {
            throw new HttpException(404);
        }

        try {
            $topic->delete();
        } catch (Exception $e) {
            throw new HttpException(500, 'DB Chyba: ' . $e->getMessage());
        }
        return $this->redirect($this->url('forum.index'));
    }

    /**
     * Checks if the logged-in user can edit and delete the topic with the id from the request:
     * the admin can manage every topic, other users only their own.
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
        $topic = Topic::getOne((int)$request->value('id'));
        if (is_null($topic)) {
            return false;
        }
        // Roly zatial nemame, admin je testovaci ucet s menom Admin
        if ($this->user->getName() == 'Admin') {
            return true;
        }
        return $topic->getAuthor() == $this->user->getName();
    }

    /**
     * Checks the values of the topic before saving.
     *
     * @param Topic $topic
     * @return array List of error messages, empty if everything is OK.
     */
    private function formErrors(Topic $topic): array
    {
        $errors = [];
        // mb_strlen pocita znaky, nie bajty (dolezite pre slovenske znaky ako č, ž, ô)
        if ($topic->getTitle() == "") {
            $errors[] = "Pole Názov témy musí byť vyplnené!";
        } elseif (mb_strlen($topic->getTitle()) < 5 || mb_strlen($topic->getTitle()) > 150) {
            $errors[] = "Názov témy musí mať 5 až 150 znakov!";
        }
        if ($topic->getText() == "") {
            $errors[] = "Pole Text príspevku musí byť vyplnené!";
        } elseif (mb_strlen($topic->getText()) < 10) {
            $errors[] = "Text príspevku musí mať aspoň 10 znakov!";
        }
        return $errors;
    }
}

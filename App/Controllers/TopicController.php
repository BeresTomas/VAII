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
     * Only logged-in users can manage topics. Others are redirected to the login page.
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
            // Datum zalozenia sa nastavi len pri novej teme, pri uprave zostane povodny
            $topic->setCreatedAt(date('Y-m-d H:i:s'));
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

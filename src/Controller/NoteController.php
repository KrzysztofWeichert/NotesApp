<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;


class NoteController extends AbstractController
{
    private const DEFAULT_SIZE = 10;
    public function create()
    {
        if ($this->request->hasPost()) {
            $noteData = [
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
            if (strlen($noteData['title']) > 0 && strlen($noteData['title']) < 255) {
                $this->noteModel->create($noteData);
                $this->redirect('/', ['info' => 'created']);
            }
            else{
                $this->redirect('/', ['info' => 'wrongtitle']);
            }
        }
        (new View)->render('create');
    }

    public function show()
    {
        $noteId = (int) ($this->request->getParam('id'));
        $noteData = $this->noteModel->get($noteId);
        (new View)->render('show', $noteData);
    }

    public function list()
    {

        $searchText = $this->request->getParam('searchtext');
        $pageNumber = (int)$this->request->getParam('page', 1);
        $pageSize = (int)$this->request->getParam('pagesize', self::DEFAULT_SIZE);
        $sortBy = $this->request->getParam('sortby', 'date');
        $sortOrder = $this->request->getParam('sortorder', 'desc');

        if ($searchText) {
            if (!in_array($pageSize, [1, 5, 10]))
                $pageSize = self::DEFAULT_SIZE;

            $notes = $this->noteModel->search($sortBy, $sortOrder, $pageSize, $pageNumber, $searchText);
            $notesNumber = $this->noteModel->searchCount($searchText);
        } else {
            if (!in_array($pageSize, [1, 5, 10]))
                $pageSize = self::DEFAULT_SIZE;

            $notes = $this->noteModel->list($sortBy, $sortOrder, $pageSize, $pageNumber);
            $notesNumber = $this->noteModel->allCount();
        }
        if (!in_array($pageSize, [1, 5, 10]))
            $pageSize = self::DEFAULT_SIZE;

        (new View)->render(
            'list',
            [
                'notesNumber' => $notesNumber,
                'page' => [
                    'number' => $pageNumber,
                    'size' => $pageSize,
                    'pages' => ceil($notesNumber / $pageSize)
                ],
                'searchtext' => $searchText,
                'sort' => ['by' => $sortBy, 'order' => $sortOrder],
                'info' => $this->request->getParam('info') ?? null,
                'notes' => $notes
            ]
        );
    }

    public function edit()
    {
        if ($this->request->hasPost()) {
            $noteData = [
                'id' => $this->request->getParam('id'),
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description')
            ];
            $this->noteModel->edit($noteData);
            $this->redirect('/', ['info' => 'edited']);
        }
        $noteId = (int) ($this->request->getParam('id'));
        (new View)->render('edit', $this->noteModel->get($noteId));
    }

    public function delete()
    {
        $noteId = (int) ($this->request->getParam('id'));
        $noteData = ['id' => $noteId];
        (new View)->render('delete', $noteData);
        if ($this->request->postParam('confirm') === 'YES') {
            $this->noteModel->delete($noteId);
            $this->redirect('/', ['info' => 'deleted']);
        } elseif ($this->request->postParam('confirm') === 'NO')
            $this->redirect('/', []);
    }
}

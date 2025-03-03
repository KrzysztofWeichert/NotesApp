<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\NoteModel;
use App\Request;
use Error;
use Exception;

require_once('../NotesApp/src/Model/NoteModel.php');

abstract class AbstractController
{
    protected const DEFAULT_ACTION = 'list';
    protected NoteModel $noteModel;
    protected Request $request;

    public function __construct(Request $request, array $db_config)
    {
        $this->request = $request;
        $this->noteModel = new NoteModel($db_config);
    }

    public function run(): void
    {
        try{
        $action = $this->action();
        if (method_exists($this, $action))
            $this->$action();
        else
            $this->redirect('/', []);
        }catch(Exception|Error $e){
            echo 'We got an error. Try again later or contact with administrator.';
            dumper($e);
        }
    }

    protected function redirect(string $to, array $params): void
    {
        $location = $to;
        if ($params) {
            foreach ($params as $key => $value) {
                $queryParams = urlencode($key) . '=' . urlencode($value);
            }
            $location .= '?' . $queryParams;
        }
        header("Location: $location");
        exit;
    }

    private function action(): string
    {
        return $this->request->getParam('action') ?? self::DEFAULT_ACTION;
    }
}

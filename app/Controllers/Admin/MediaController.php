<?php

namespace App\Controllers\Admin;

use App\Services\MediaService;
use Core\Controller;
use Core\Request;
use Core\Response;

class MediaController extends BaseController
{
    private MediaService $mediaService;

    public function __construct()
    {
        parent::__construct();
        $this->mediaService = new MediaService();
    }

    public function index(Request $request): void
    {
        $page = (int) $request->input('page', 1);
        $type = $request->input('type', '');

        $pagination = $this->mediaService->getAll($page, $type);

        $this->render('admin.media.index', compact('pagination', 'type'));
    }

    public function upload(Request $request): void
    {
        if (!$request->isPost() || !$request->hasFile('file')) {
            Response::json(['success' => false, 'message' => 'No file uploaded.'], 400);
            return;
        }

        $directory = $request->input('directory', '');
        $result = $this->mediaService->upload($request->file('file'), $directory);

        if (!$result) {
            Response::json(['success' => false, 'message' => 'File upload failed.'], 400);
            return;
        }

        Response::json(['success' => true, 'data' => $result]);
    }

    public function delete(Request $request, int $id): void
    {
        if ($this->mediaService->delete($id)) {
            $this->session->flash('success', 'Media deleted successfully.');
        } else {
            $this->session->flash('error', 'Failed to delete media.');
        }

        $this->back();
    }
}

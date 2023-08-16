<?php

namespace App\Http\Controllers;

use App\Repositories\WebMD\WebMDInterface;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class WebMDController extends Controller
{
    private $webMD;
    private $category;

    public function __construct(WebMDInterface $webMD, CategoryService $category)
    {
        $this->webMD = $webMD;
        $this->category = $category;
    }

    public function index() {
        $categories = $this->webMD->categories('Expert');
        $createResponse = $this->category->create($categories);

        if($createResponse['success']) {
            return response()->json($createResponse);
        } else {
            return response()->json($createResponse);
        }
    }

    public function categoryBlogs() {
        $categories = $this->category->getAll();
        $data = array();
        foreach($categories as $index=>$category) {

            $data[] = $this->webMD->blogList($category);

            sleep(5);
        }

        return response()->json($data);
    }
}
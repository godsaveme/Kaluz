<?php

namespace Salesfly\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Intervention\Image\Facades\Image;

class InventoryController extends Controller {
    public function index()
    {
        return View('inventory.index');
    }
}
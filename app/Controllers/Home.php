<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Home extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        // Load the Product model
        $this->productModel = new ProductModel();
    }

    public function index(): string
    {
        $data['products'] = $this->productModel->findAll(); // Fetch all products

        // Prepare the view data
        $data['title'] = 'Shop';
        $data['content'] = view('shop/shop', $data); // Load the products view

        // Return the main layout view
        return view('layouts/main', $data);
    }
}

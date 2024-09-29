<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductController extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        // Load the Product model
        $this->productModel = new ProductModel();
    }

    // Display all products
    public function index()
    {
        try {
            // Fetch all products, notice the intentional typo here in the method name to simulate a bug
            $data['products'] = $this->productModel->findAl(); // This should cause an error

            // Prepare the view data
            $data['title'] = 'ABC'; // Set the page title
            $data['content'] = view('products/index', $data); // Load the products view

            // Return the main layout view
            return view('layouts/main', $data);
        } catch (\Throwable $e) {
            // Catch the error and display it in the browser
            return $this->response->setBody("<h1>An error occurred:</h1><pre>" . $e->getMessage() . "</pre>");
        }
    }

    // Show form for creating a new product
    public function create()
    {
        $data['title'] = 'Create Product'; // Set the title for the create page
        $data['content'] = view('products/create'); // Load the create view
        return view('layouts/main', $data);
    }

    // Store a newly created product
    public function store()
    {
        // Validate input before saving
        if ($this->validateInput()) {
            // Save the product data
            $this->productModel->save([
                'name' => $this->request->getVar('name'),
                'price' => $this->request->getVar('price'),
                'description' => $this->request->getVar('description'),
            ]);
            return redirect()->to('/products')->with('success', 'Product created successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Show the specified product
    public function show($id)
    {
        $data['product'] = $this->productModel->find($id);

        if (!$data['product']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        $data['title'] = $data['product']['name']; // Set the title to the product name
        $data['content'] = view('products/show', $data); // Load the show view
        return view('layouts/main', $data);
    }

    // Show form for editing a product
    public function edit($id)
    {
        $data['product'] = $this->productModel->find($id);

        if (!$data['product']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        $data['title'] = 'Edit Product'; // Set the title for the edit page
        $data['content'] = view('products/edit', $data); // Load the edit view
        return view('layouts/main', $data);
    }

    // Update the specified product
    public function update($id)
    {
        // Validate input before updating
        if ($this->validateInput()) {
            $this->productModel->update($id, [
                'name' => $this->request->getVar('name'),
                'price' => $this->request->getVar('price'),
                'description' => $this->request->getVar('description'),
            ]);
            return redirect()->to('/products')->with('success', 'Product updated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Remove the specified product
    public function delete($id)
    {
        $this->productModel->delete($id);
        return redirect()->to('/products')->with('success', 'Product deleted successfully.');
    }

    // Input validation method
    private function validateInput()
    {
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'name' => 'required|min_length[3]|max_length[100]',
            'price' => 'required|decimal',
            'description' => 'required'
        ]);

        return $this->validate($validation->getRules()); // Return validation status
    }
}

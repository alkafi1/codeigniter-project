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
            // Fetch search query and sorting parameters
            $search = $this->request->getGet('search') ?? '';
            $sort = $this->request->getGet('sort') ?? 'created_at';
            $order = $this->request->getGet('order') ?? 'DESC';

            // Configure pagination
            $perPage = 10; // Products per page
            $page = $this->request->getGet('page') ?? 1;
            $offset = ($page - 1) * $perPage;

            // Get products with search, sorting, and pagination
            $data['products'] = $this->productModel->getProducts($perPage, $offset, $search, $sort, $order);
            $data['total'] = $this->productModel->countAll($search);

            // Prepare pagination links
            $data['pagination'] = $this->createPagination($page, $data['total'], $perPage);

            // Prepare the view data
            $data['title'] = 'Product List'; // Set the page title
            $data['search'] = $search; // For keeping the search term in the view
            $data['sort'] = $sort; // For keeping the sort column in the view
            $data['order'] = $order; // For keeping the sort order in the view
            $data['content'] = view('products/index', $data); // Load the products view

            // Return the main layout view
            return view('layouts/main', $data);
        } catch (\Throwable $e) {
            // Catch the error and display it in the browser
            return $this->response->setBody("<h1>An error occurred:</h1><pre>" . esc($e->getMessage()) . "</pre>");
        }
    }
    private function createPagination($currentPage, $totalRows, $perPage)
    {
        $pager = service('pager');
        return $pager->makeLinks($currentPage, $perPage, $totalRows);
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
        if (!$this->validateInput()) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Save the product data if validation passes
        $this->productModel->save([
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'description' => $this->request->getVar('description'),
        ]);

        return redirect()->to('/products')->with('success', 'Product created successfully.');
    }

    // Show the specified product
    public function show($id)
    {
        // Retrieve the product by its ID
        $data['product'] = $this->productModel->find($id);

        // Check if product exists
        if (!$data['product']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Product not found');
        }

        // Set the title dynamically
        $data['title'] = $data['product']['name'];

        // Load the main layout with the content view
        return view('layouts/main', [
            'content' => view('products/show', $data),
            'title' => $data['title']
        ]);
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

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;
use App\Models\RoleModel;

class User extends BaseController
{
    public function index()
    {   
        $deptModel = new DepartmentModel();
        $data['departments'] = $deptModel->findAll();

        return view('dashboard/user', $data);
    }




    // // Create User Function 
    // public function create()
    // {
    //     if (!$this->request->isAJAX()) {
    //         return redirect()->back();
    //     }

    //     $data = [
            
    //         'name'   => $this->request->getPost('name'),
    //         'company_name'   => $this->request->getPost('company_name'),
    //         'department_id'  => $this->request->getPost('department_id'),
    //         'email'          => $this->request->getPost('email'),
    //         'employee_code'  => $this->request->getPost('employee_code'),
    //         'username'       => $this->request->getPost('username'),
    //         'password'       => md5($this->request->getPost('password') . "HASHKEY123"),
    //         'role_id'        => $this->request->getPost('role_id'),
    //         'hash_key'       => "HASHKEY123",
    //         'active'         => 1,
    //         'created_by'     => session()->get('user_id')
    //     ];

    //     $userModel = new \App\Models\UserModel();

    //     if ($userModel->insert($data)) {
    //         return $this->response->setJSON([
    //             'status'  => 'success',
    //             'message' => 'User created successfully'
    //         ]);
    //     }

    //     return $this->response->setJSON([
    //         'status'  => 'error',
    //         'message' => 'Failed to create user'
    //     ]);
    // }



    public function create()
{
    if (!$this->request->isAJAX()) {
        return redirect()->back();
    }

    $username = $this->request->getPost('username');
    $email = $this->request->getPost('email');

    $userModel = new \App\Models\UserModel();

    // 🔍 Check if username already exists
    if ($userModel->where('username', $username)->first()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Username already exists. Please choose another.'
        ]);
    }

    // 🔍 Optional: Check if email exists
    if ($userModel->where('email', $email)->first()) {
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Email already registered.'
        ]);
    }

    // Insert Data
    $data = [
        'name'           => $this->request->getPost('name'),
        'priority'       => $this->request->getPost('priority'),
        'company_name'   => $this->request->getPost('company_name'),
        'department_id'  => $this->request->getPost('department_id'),
        'email'          => $email,
        'employee_code'  => $this->request->getPost('employee_code'),
        'username'       => $username,
        'password'       => md5($this->request->getPost('password') . "HASHKEY123"),
        'role_id'        => $this->request->getPost('role_id'),
        'hash_key'       => "HASHKEY123",
        'active'         => 1,
        'created_by'     => session()->get('user_id')
    ];

    if ($userModel->insert($data)) {
        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'User created successfully'
        ]);
    }

    return $this->response->setJSON([
        'status'  => 'error',
        'message' => 'Failed to create user'
    ]);
}
    
    // public function userListData()
    // {

    //     $deptModel = new DepartmentModel();
    //     $userModel = new UserModel();

    //     $data['users'] = $userModel
    //         ->select('users.*, departments.department_name, roles.role_name')
    //         ->join('departments', 'departments.id = users.department_id')
    //         ->join('roles', 'roles.id = users.role_id')
    //         ->findAll();
    //     $data['departments'] = $deptModel->findAll();
    //     return view('dashboard/userlist', $data);

        
    // }


    // public function userListData()
    // {
    //     $session = session();
    //     $deptModel = new DepartmentModel();
    //     $userModel = new UserModel();

    //     $userRole = $session->get('role_id');          // 1 = Admin, 2 = Department Head
    //     $userDept = $session->get('department_id');    // Logged user's department

    //     // Base Query
    //     $userModel
    //         ->select('users.*, departments.department_name, roles.role_name')
    //         ->join('departments', 'departments.id = users.department_id')
    //         ->join('roles', 'roles.id = users.role_id');

    //     // Apply filter ONLY if role is 2
    //     if ($userRole == 2) {
    //         $userModel->where('users.department_id', $userDept);
    //     }

    //     $data['users'] = $userModel->findAll();
    //     $data['departments'] = $deptModel->findAll();

    //     return view('dashboard/userlist', $data);
    // }

    public function userListData()
{
    $session = session();
    $deptModel = new DepartmentModel();
    $roleModel = new RoleModel();
    $userModel = new UserModel();

    // Logged-in user info
    $userRole = $session->get('role_id');          // 1 = Admin, 2 = Department Head
    $userDept = $session->get('department_id');    // Logged user's dept

    // Filters from GET
    $company    = $this->request->getGet('company');
    $department = $this->request->getGet('department');
    $role       = $this->request->getGet('role');

    // Base Query
    $userModel
        ->select('users.*, departments.department_name, roles.role_name')
        ->join('departments', 'departments.id = users.department_id', 'left')
        ->join('roles', 'roles.id = users.role_id', 'left');

    // Restrict department for role_id = 2
    if ($userRole == 2) {
        $userModel->where('users.department_id', $userDept);
    }

    // Apply filters
    if (!empty($company)) {
        $userModel->where('users.company_name', $company);
    }

    if (!empty($department)) {
        $userModel->where('users.department_id', $department);
    }

    if (!empty($role)) {
        $userModel->where('users.role_id', $role);
    }

    // Fetch data
    $data['users']       = $userModel->findAll();
    $data['departments'] = $deptModel->findAll();
    $data['roles']       = $roleModel->findAll();

    return view('dashboard/userlist', $data);
}



    public function update()
    {
        $id = $this->request->getPost('id');

        $data = [
            'company_name'  => $this->request->getPost('company_name'),
            'department_id' => $this->request->getPost('department_id'),
            'email'         => $this->request->getPost('email'),
            'employee_code' => $this->request->getPost('employee_code'),
            'name' => $this->request->getPost('name'),
            'priority' => $this->request->getPost('priority'),
        ];

        (new UserModel())->update($id, $data);

        return $this->response->setJSON(['status'=>'success','message'=>'User Updated']);
    }


    public function get($id)
    {
        $model = new UserModel();
        return $this->response->setJSON($model->find($id));
    }


    public function toggleStatus()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getPost('id');
            $userModel = new \App\Models\UserModel();

            // Find user
            $user = $userModel->find($id);
            if (!$user) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'User not found!'
                ]);
            }

            // Toggle status
            $newStatus = ($user['active'] == 1) ? 0 : 1;
            $userModel->update($id, ['active' => $newStatus]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => $newStatus ? 'User Activated' : 'User Deactivated',
                'new_status' => $newStatus
            ]);
        }

        // Non-AJAX fallback
        return redirect()->back()->with('error', 'Invalid request');
    }

}

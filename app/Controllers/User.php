<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DepartmentModel;

class User extends BaseController
{
    public function index()
    {   
        $deptModel = new DepartmentModel();
        $data['departments'] = $deptModel->findAll();

        return view('dashboard/user', $data);
    }


    // Create User Function 
    public function create()
    {
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        $data = [
            
            'name'   => $this->request->getPost('name'),
            'company_name'   => $this->request->getPost('company_name'),
            'department_id'  => $this->request->getPost('department_id'),
            'email'          => $this->request->getPost('email'),
            'employee_code'  => $this->request->getPost('employee_code'),
            'username'       => $this->request->getPost('username'),
            'password'       => md5($this->request->getPost('password') . "HASHKEY123"),
            'role_id'        => $this->request->getPost('role_id'),
            'hash_key'       => "HASHKEY123",
            'active'         => 1,
            'created_by'     => session()->get('user_id')
        ];

        $userModel = new \App\Models\UserModel();

        if ($userModel->insert($data)) {
            return $this->response->setJSON([
                'status'  => 'success',
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


    public function userListData()
    {
        $session = session();
        $deptModel = new DepartmentModel();
        $userModel = new UserModel();

        $userRole = $session->get('role_id');          // 1 = Admin, 2 = Department Head
        $userDept = $session->get('department_id');    // Logged user's department

        // Base Query
        $userModel
            ->select('users.*, departments.department_name, roles.role_name')
            ->join('departments', 'departments.id = users.department_id')
            ->join('roles', 'roles.id = users.role_id');

        // Apply filter ONLY if role is 2
        if ($userRole == 2) {
            $userModel->where('users.department_id', $userDept);
        }

        $data['users'] = $userModel->findAll();
        $data['departments'] = $deptModel->findAll();

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

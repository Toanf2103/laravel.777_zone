<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Employee\CreateEmployeeRequest;
use App\Models\User;
use App\Services\AddressService;
use App\Services\FirebaseStorageService;

class EmployeeController extends Controller
{
    protected $addressService;
    protected $firebaseStorageService;

    public function __construct(AddressService $addressService, FirebaseStorageService $firebaseStorageService)
    {
        $this->middleware('admin');

        $this->addressService = $addressService;
        $this->firebaseStorageService = $firebaseStorageService;
    }

    private function checkAdmin()
    {
        return Auth::guard('admin')->user()->role == 'admin' ? true : false;
    }

    public function index()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $employees = User::where('role', 'employee')->orderBy('id', 'desc')->paginate(20);

        foreach ($employees as $index => $employee) {
            $address = $this->addressService->getDetailByWardId($employee->ward_id);
            $employees[$index]['full_address'] = "{$employee->address}, {$address['districts']['wards']['name']}, {$address['districts']['name']}, {$address['name']}";
        }

        return view('admin.pages.employee.index', compact('employees'));
    }

    public function create()
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.pages.employee.create');
    }

    public function store(CreateEmployeeRequest $request)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        User::create([
            'full_name' => ucwords($request->full_name),
            'phone_number' => $request->phone_number,
            'email' => $request->input('email'),
            'avatar' => 'https://storage.googleapis.com/laravel-img.appspot.com/user/employee-default.png',
            'username' => $request->username,
            'password' => bcrypt('Admin@123'),
            'ward_id' => $request->ward,
            'address' => $request->address,
            'role' => 'employee',
            'status' => $request->status,
        ]);

        return redirect()->route('admin.employees.index')->with("success", "Thêm nhân viên thành công!");
    }

    public function toggleStatus(User $employee)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($employee->role != 'employee') {
            return redirect()->back()->with('error', 'Bạn không có quyền thực hiện hành động này');
        }

        if ($employee->status) {
            $dataUpdate = ['status' => 0];
            $message = 'Khóa tài khoản thành công!';
        } else {
            $dataUpdate = ['status' => 1];
            $message = 'Mở khóa tài khoản thành công!';
        }
        $employee->update($dataUpdate);

        return redirect()->back()->with('success', $message);
    }

    public function resetPassword(User $employee)
    {
        if (!$this->checkAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($employee->role != 'employee') {
            return redirect()->back()->with('error', 'Bạn không có quyền thực hiện hành động này');
        }

        $employee->update(['password' => bcrypt('Admin@123')]);

        return redirect()->back()->with('success', 'Đặt lại mật khẩu thành công');
    }
}

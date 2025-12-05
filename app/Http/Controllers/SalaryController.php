<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function index(Request $request)
    {
        $query = Salary::with('employee.department', 'employee.position');
        
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }
        
        if ($request->filled('karyawan_id')) {
            $query->where('karyawan_id', $request->karyawan_id);
        }
        
        if ($request->filled('min_gaji')) {
            $query->where('total_gaji', '>=', $request->min_gaji);
        }
        
        $salaries = $query->latest()->get();
        $employees = Employee::all();
        
        return view('salaries.index', compact('salaries', 'employees'));
    }

    public function create()
    {
        $employees = Employee::with('position')->get();
        return view('salaries.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'total_gaji' => 'required|numeric|min:0'
        ]);

        Salary::create($request->all());

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function show(Salary $salary)
    {
        $salary->load('employee.department', 'employee.position');
        return view('salaries.show', compact('salary'));
    }

    public function edit(Salary $salary)
    {
        $salary->load('employee');
        return view('salaries.edit', compact('salary'));
    }

    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
            'total_gaji' => 'required|numeric|min:0'
        ]);

        $salary->update($request->all());

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    public function destroy(Salary $salary)
    {
        $salary->delete();

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }
}
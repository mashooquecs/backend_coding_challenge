<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\AppHumanResources\Attendance\Application\AttendanceService;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AttendanceController extends Controller
{
    protected $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function getAttendanceInformation($employeeId)
    {
        // Retrieve employee
        $employee = Employee::findOrFail($employeeId);

        // Get attendance information with total working hours
        $attendanceInformation = $this->attendanceService->getAttendanceInformation($employee);

        // Return the attendance information as a JSON response
        return response()->json($attendanceInformation);
    }
    public function uploadAttendance(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Retrieve the uploaded file
        $file = $request->file('file');
        // Load the Excel file using PhpSpreadsheet
        $spreadsheet = IOFactory::load($file);

        // Get the active sheet
        $worksheet = $spreadsheet->getActiveSheet();

        // Get the highest column index and row number
        $highestColumnIndex = Coordinate::columnIndexFromString($worksheet->getHighestColumn());
        $highestRow = $worksheet->getHighestRow();

        // Process and store the attendance data
        for ($row = 2; $row <= $highestRow; $row++) {
            $rowData = [];
            for ($col = 1; $col <= $highestColumnIndex; $col++) {
                $cellValue = $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                $rowData[] = $cellValue;
            }
            $attendance = new Attendance();
            $attendance->employee_id    = $request->employee_id; // Assuming employee ID is in the first column
            $attendance->check_in       = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rowData[0])->format('Y-m-d H:i:s'); // Assuming check-in time is in the second column
            $attendance->check_out      = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rowData[1])->format('Y-m-d H:i:s'); // Assuming check-out time is in the third column
            $attendance->total_working_hours = $rowData[2];
            $attendance->save();
        }

        // Return a response indicating successful upload
        return response()->json(['message' => 'Attendance uploaded successfully']);
    }
}

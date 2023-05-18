<?php
namespace App\AppHumanResources\Attendance\Application;

use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceService
{
    public function getAttendanceInformation(Employee $employee)
    {
        $attendanceInformation = [];

        // Retrieve attendance records for the employee
        $attendances = Attendance::where('employee_id', $employee->id)->get();

        foreach ($attendances as $attendance) {
            $checkIn = $attendance->check_in;
            $checkOut = $attendance->check_out;

            // Calculate the total working hours
            $totalWorkingHours = $attendance->total_working_hours;

            // Build the attendance information array
            $attendanceInformation[] = [
                'name' => $employee->name,
                'checkin' => $checkIn,
                'checkout' => $checkOut,
                'totalWorkingHours' => $totalWorkingHours,
            ];
        }

        return $attendanceInformation;
    }
}

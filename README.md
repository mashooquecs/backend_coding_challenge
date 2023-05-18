

# Challenge 1: 

## Introduction
This project allows users to upload attendance data in Excel format, store it in a database, and retrieve attendance information for employees. It provides an API endpoint for uploading attendance data, another endpoint for retrieving attendance information for an employee along with total working hours.


## Installation
1. Clone the repository from GitHub:
    ``` git clone https://github.com/your_username/attendance-management.git ```
2. Navigate to the project directory:
    ``` cd attendance-management ```
3. Install dependencies using Composer:
    ``` composer install ```
4. Configure the database connection by editing the .env file and providing the necessary details.
5. Run the database migrations to create the required tables:
    ``` php artisan migrate ```
6. Start the development server:
    ``` php artisan serve ```



## Usage

Uploading Attendance Data
To upload attendance data, make a POST request with file & employee_id form data to the following API endpoint:
  ``` POST /api/attendance/upload ```

 The request should include an Excel file containing the attendance data. The API endpoint will process the file, extract the relevant information, and store it in the database.


Retrieving Attendance Information
To retrieve attendance information for an employee along with total working hours, make a GET request to the following API endpoint:
  ``` GET /api/attendance/{employee_id}/information ```



Project Structure
The project follows a standard structure to maintain code organization. Here are the key components:

app/AppHumanResources/Attendance/Application/AttendanceService.php: Contains the service class responsible for handling attendance-related business logic.

app/AppHumanResources/Attendance/Domain/Attendance.php: Defines the model class for attendance data.

app/Http/Controllers/AttendanceController.php: Implements the controller class for attendance management. It calls the methods from the AttendanceService class to handle the API endpoints.

<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\McqsBankController;
use App\Http\Controllers\McqsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CandidateAuthController;
use App\Http\Controllers\SubAdminAuthController;
use App\Http\Controllers\SuperAdminAuthController;
//TO BCRYPT PASSWPRD
use Illuminate\Support\Facades\Hash;


// Landing Page
Route::get('/', function () {
    return view('home');
});
Route::get('/', [HomeController::class, 'index'])->name('home');

// Super Admin Routes
// Route::prefix('superadmin')->group(function () {
//     Route::get('/login', [SuperAdminAuthController::class, 'showLoginForm'])->name('superadmin.login');
//     Route::post('/login', [SuperAdminAuthController::class, 'login'])->name('superadmin.login');
//     Route::post('/logout', [SuperAdminAuthController::class, 'logout'])->name('superadmin.logout');

//     Route::middleware(['auth:super_admin'])->group(function () {
//         Route::get('/dashboard', [AdminController::class, 'index'])->name('superadmin.dashboard');
//     });
// });

// Sub Admin Routes
// Route::prefix('subadmin')->group(function () {
//     Route::get('/login', [SubAdminAuthController::class, 'showLoginForm'])->name('subadmin.login');
//     Route::post('/login', [SubAdminAuthController::class, 'login'])->name('subadmin.login');
//     Route::post('/logout', [SubAdminAuthController::class, 'logout'])->name('subadmin.logout');

//     Route::middleware(['auth:sub_admin'])->group(function () {
//         Route::get('/dashboard', [AdminController::class, 'index'])->name('subadmin.dashboard');
//     });
// });

// Candidate Routes
// Route::prefix('candidate')->group(function () {
//     Route::get('/login', [CandidateAuthController::class, 'showLoginForm'])->name('candidate.login');
//     Route::post('/login', [CandidateAuthController::class, 'login'])->name('candidate.login');
//     Route::post('/logout', [CandidateAuthController::class, 'logout'])->name('candidate.logout');

//     Route::middleware(['auth:candidate'])->group(function () {
//         Route::get('/dashboard', [CandidateController::class, 'index'])->name('candidate.dashboard');
//     });
// });

// Admin Authentication Routes
Route::get('/admin/showLoginForm', [AdminAuthController::class, 'showLoginForm'])->name('admin.showLoginForm');
Route::post('/admin/showLoginForm', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //Add Program
    Route::get('/Admin/addProgram', [ProgramController::class, 'create'])->name('addProgram');

    Route::post('/Admin/addProgram', [ProgramController::class, 'store'])->name('insert-program');

    // Add department
    Route::get('/Admin/addDepartment', [DepartmentController::class, 'index'])->name('addDepartment');

    Route::post('/Admin/addDepartment', [DepartmentController::class, 'store'])->name('insert-department');

    Route::get('/Admin/departmentList', [DepartmentController::class, 'show'])->name('departmentList');

    // Add course
    Route::get('/Admin/addCourse', [CourseController::class, 'index'])->name('admin.addCourse');

    Route::post('/Admin/addCourse', [CourseController::class, 'store'])->name('admin.insert-course');

    //Show all courses list
    Route::get('/Admin/coursesList', [CourseController::class, 'show'])->name('showCourses');

    //viewing MCQs Bank
    Route::get('/Admin/mcqsBank', [McqsController::class, 'index'])->name('mcqs.index');

    //Adding MCQS form
    Route::get('/Admin/addMcqs', [McqsController::class, 'create'])->name('mcqs.upload.form');
    Route::get('/departments/{department}/courses', [McqsController::class, 'getCourses'])->name('departments.courses');


    //Adding mcqs file (Second Methodd)
    Route::get('/Admin/addMcqsFile', [McqsBankController::class, 'create'])->name('get-upload-mcqs-form');
    Route::post('/Admin/addMcqsFile', [McqsBankController::class, 'upload'])->name('upload-mcqs-file');

    //Displaying Mcqs bank page (second)
    Route::get('/Admin/mcqsBankPage', [McqsBankController::class, 'index'])->name('mcqs-bank-page');

    //uploading mcqs
    Route::post('/Admin/addMcqs', [McqsController::class, 'store'])->name('mcqs.upload');

    Route::post('/mcqs/format', [McqsController::class, 'switchFormat'])->name('mcqs.switchFormat');

    //Upload candidates file
    Route::get('/Admin/addCandidatesForm', [CandidateController::class, 'showUploadForm'])->name('show-upload-candidates-form');
    Route::post('/Admin/addCandidatesForm', [CandidateController::class, 'uploadForm'])->name('upload-candidates-form');

    //show candidates list
    Route::get('/Admin/candidatesList', [CandidateController::class, 'show'])->name('show-candidates-list');

    //Test creation
    Route::get('/Admin/createtest', [TestController::class, 'create'])->name('createTestForm');
    Route::post('/Admin/createtest', [TestController::class, 'store'])->name('tests.store');
    Route::get('/Admin/preparedTests', [TestController::class, 'showPreparedTests'])->name('preparedTests');
    Route::delete('/Admin/tests/{test}', [TestController::class, 'destroy'])->name('tests.destroy');

    Route::get('/Admin/results', [TestController::class, 'results'])->name('Admin.results');
    Route::get('/admin/search-results', [AdminController::class, 'searchResults'])->name('admin.searchResults');
    Route::post('/admin/export-results', [TestController::class, 'exportResults'])->name('admin.exportResults');



});


// Candidates pages Routes
Route::get('/candidate/loginForm', [CandidateAuthController::class, 'showLoginForm'])->name('candidate.loginForm');
Route::post('/candidate/loginForm', [CandidateAuthController::class, 'login'])->name('candidate.login');
Route::post('/Candidate/logout', [CandidateAuthController::class, 'logout'])->name('candidate.logout');
Route::middleware(['auth:candidate'])->group(function () {
    Route::get('Candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');
    Route::get('Candidate/skip-demo', [CandidateController::class, 'departmentSelectionPage'])->name('department-selection-page');
    Route::post('/candidate/start-demo', [CandidateController::class, 'startDemo'])->name('candidate.start-demo');
    Route::post('/candidate/submit-demo', [CandidateController::class, 'departmentSelectionPage'])->name('candidate.submit-demo');
    Route::post('/select-department', [CandidateController::class, 'selectDepartment'])->name('candidate.selectDepartment');
    Route::get('/Candidate/pre-test/{test_id}', [CandidateController::class, 'preTest'])->name('candidate.preTest');
    Route::get('/start-test/{test_id}', [CandidateController::class, 'startTest'])->name('candidate.startTest');
    Route::post('/test/submit/{test_id}', [CandidateController::class, 'submitTest'])->name('candidate.submitTest');

});

// Temporary routes

Route::get('Candidate/demoTestPage', function () {
    return view('Candidate.demoTestPage');
});

Route::get('testPage', function () {
    return view('Candidate.testPage');
});

// temporary routes ends


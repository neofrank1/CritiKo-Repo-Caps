<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\KlaseController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\KlaseDetController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\BlockStudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Home page
Route::get('/', [UserController::class, 'home']);

//User routes
//Show register form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
//Store user data
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
//Show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//Authenticate user
Route::post('/users/auth', [UserController::class, 'auth'])->middleware('guest');
//Logout user
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Temp auth routes
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

//Department Routes
//Show manage department page
Route::get('/department/manage', [DepartmentController::class, 'manage'])->middleware('auth');
//Show Create Department Form
Route::get('/department/create', [DepartmentController::class, 'create'])->middleware('auth');
//Store Departmment Data
Route::post('/department', [DepartmentController::class, 'store']);
//Show Edit Department Form
Route::get('/department/{department}/edit', [DepartmentController::class, 'edit'])->middleware('auth');
//Update Department Data
Route::put('department/{department}', [DepartmentController::class, 'update'])->middleware('auth');
//Delete Department 
Route::delete('/department/{department}', [DepartmentController::class, 'delete'])->middleware('auth');

//Course Routes
//Course main page
Route::get('/course', [CourseController::class, 'main'])->middleware('auth');
//Show manage course page
Route::get('/course/manage/{department}', [CourseController::class, 'manage'])->middleware('auth');
//Show create course form
Route::get('/course/create/{department}', [CourseController::class, 'create'])->middleware('auth');
//Store course data
Route::post('/course', [CourseController::class, 'store'])->middleware('auth');
//Show Edit Course form
Route::get('/course/{course}/edit', [CourseController::class, 'edit'])->middleware('auth');
//Update Course Data
Route::put('/course/{course}', [CourseController::class, 'update'])->middleware('auth');
//Delete Course
Route::delete('/course/{course}', [CourseController::class, 'delete'])->middleware('auth');

//Subject Routes
//Subject main page
Route::get('/subject', [SubjectController::class, 'main'])->middleware('auth');
//Show manage subject page
Route::get('/subject/manage/{course}', [SubjectController::class, 'manage'])->middleware('auth');
//Show create subject form
Route::get('/subject/create/{course}', [SubjectController::class,'create'])->middleware('auth');
//Store subject data
Route::post('/subject', [SubjectController::class, 'store'])->middleware('auth');
//Show edit subject form
Route::get('/subject/{subject}/edit', [SubjectController::class, 'edit'])->middleware('auth');
//Update subject data
Route::put('/subject/{subject}', [SubjectController::class, 'update'])->middleware('auth');
//Dete Subject
Route::delete('/subject/{subject}', [SubjectController::class, 'delete'])->middleware('auth');

//Block Routes
//Block main page
Route::get('/block', [BlockController::class, 'main'])->middleware('auth');
//Show manage block page
Route::get('/block/manage/{subject}', [BlockController::class, 'manage'])->middleware('auth');
//Show create block form
Route::get('/block/create/{subject}', [BlockController::class, 'create'])->middleware('auth');
//Store block data
Route::post('/block', [BlockController::class, 'store']);
//Show edit block form
Route::get('/block/{block}/edit', [BlockController::class, 'edit'])->middleware('auth');
//Update block data
Route::put('/block/{block}', [BlockController::class, 'update'])->middleware('auth');
//Delete Block
Route::delete('/block/{block}', [BlockController::class, 'delete'])->middleware('auth');

//Block Students Routes
//Show manage block students page
Route::get('/block/student/manage/{block}', [BlockStudentController::class, 'manage'])->middleware('auth');
//Show add student to block form
Route::get('/block/student/add/{block}', [BlockStudentController::class, 'add'])->middleware('auth');
//Store student to block
Route::post('/block/student', [BlockStudentController::class, 'store'])->middleware('auth');
//Delete student to block
Route::delete('/block/student/{blockStud}', [BlockStudentController::class, 'delete'])->middleware('auth');
//Add all students in block to subjects of the course
Route::get('/block/student/addToSubjects/{block}', [BlockStudentController::class, 'addToSubject'])->middleware('auth');


//Block Klase Routes
//Show manage klase page
Route::get('/block/klase/manage/{block}', [KlaseController::class, 'manage'])->middleware('auth');
//Show add subject to block form
Route::get('/block/klase/add/{block}', [KlaseController::class, 'add'])->middleware('auth');
//Store klase data
Route::post('/block/klase', [KlaseController::class, 'store'])->middleware('auth');
//Show edit klase form
Route::get('/block/klase/{klase}/edit', [KlaseController::class, 'edit'])->middleware('auth');
//Update klase data
Route::put('/block/klase/{klase}', [KlaseController::class, 'update'])->middleware('auth');
//Delete klase detail
Route::delete('/block/klase/{klase}', [KlaseController::class, 'delete'])->middleware('auth');

//Block Klase Student Routes
//Show  manage klase student page
Route::get('/block/klase/detail/manage/{klase}', [KlaseDetController::class, 'manage'])->middleware('auth');
//Show add student to klase form
Route::get('/block/klase/detail/add/{klase}', [KlaseDetController::class,  'add'])->middleware('auth');
//Store student data to class
Route::post('/block/klase/detail', [KlaseDetController::class, 'store'])->middleware('auth');
//Delete student from class
Route::delete('block/klase/detail/{klaseDet}', [KlaseDetController::class, 'delete'])->middleware('auth');

//Question Routes
//Category
//Show question categories
Route::get('/q/c', [QuestionController::class, 'manageCat']);
//Show create category form
Route::get('/q/c/create', [QuestionController::class, 'createCat']);
//Store category data
Route::post('/q/c', [QuestionController::class, 'storeCat']);
//Show edit category form
Route::get('/q/c/{cat}/edit', [QuestionController::class, 'editCat']);
//Update category data
Route::put('/q/c/{cat}', [QuestionController::class, 'updateCat']);
//Delete category data
Route::delete('/q/c/{cat}', [QuestionController::class, 'deleteCat']);
//Question
//Show question main page
Route::get('/question', [QuestionController::class, 'main']);
//Show question main page by category
Route::get('/question/manage/{cat}', [QuestionController::class, 'mByCat']);
//Show create question form
Route::get('/question/create', [QuestionController::class, 'create']);
//Store question data
Route::post('/question', [QuestionController::class, 'store']);
//Show edit question form
Route::get('/question/{question}/edit', [QuestionController::class, 'edit']);
//Update question data
Route::put('/question', [QuestionController::class, 'update']);
//Delete question data
Route::delete('/question/{question}', [QuestionController::class, 'delete']);
//Preview question
Route::get('/question/preview', [QuestionController::class, 'preview']);
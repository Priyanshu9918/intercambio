<?php

use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\Front\FrontendController::class, 'login_view'])->name('front.index');
Route::post('doUsrlgn', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('user.dologin');
Route::get('verify_email/{id}', [App\Http\Controllers\Auth\LoginController::class, 'verify_email'])->name('verify_email');

Route::post('doAdmlgn', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login'])->name('admin.dologin');
Route::get('user/logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'logout'])->name('user.logout');

Route::get('users/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout1'])->name('users.logout');

Auth::routes();
// Route::get('/', [App\Http\Controllers\Front\FrontendController::class, 'index']);
Route::get('/signup-account-select', [App\Http\Controllers\Front\FrontendController::class, 'signup'])->name('front.signup-account-select');
Route::match(['get', 'post'], '/student-signup', [App\Http\Controllers\Front\FrontendController::class, 'student'])->name('front.student-signup');
Route::group(['middleware' => ['Student']], function () {
    Route::match(['get', 'post'], '/student-signup-register/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_survey'])->name('front.student-signup-register');
    Route::match(['get', 'post'], '/student-signup-pre-survey/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_pre_survey'])->name('front.student-signup-pre-survey');
    Route::match(['get', 'post'], '/student-signup-survey/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_pre_survey_complete'])->name('front.student-signup-survey');
    Route::match(['get', 'post'], '/student-signup-time-scheduling/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_scheduling'])->name('front.student-signup-time-scheduling');
    Route::match(['get', 'post'], '/student-signup-review/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_review'])->name('front.student-signup-review');
    Route::match(['get', 'post'], '/student-verify/{id}', [App\Http\Controllers\Front\FrontendController::class, 'student_verify'])->name('front.student-verify');
    Route::match(['get', 'post'], '/resend-email/{id}', [App\Http\Controllers\Front\FrontendController::class, 'resend_email'])->name('front.resend-email');
    Route::match(['get', 'post'], '/student-zip-check/{id}', [App\Http\Controllers\Front\FrontendController::class, 'teacher_zip_check1'])->name('front.student-zip-check');
    Route::match(['get', 'post'], '/student-pairing-control', [App\Http\Controllers\Front\FrontendController::class, 'studentcontrol'])->name('front.student-pairing-control');
    Route::match(['get', 'post'], '/student-change-password', [App\Http\Controllers\Front\FrontendController::class, 'studentchangepass'])->name('front.student-change-password');
    Route::post('/change-password12', [App\Http\Controllers\PasswordChangeController::class, 'changePassword12'])->name('student.password.update');
    Route::match(['get', 'post'], '/student-pairing-control1', [App\Http\Controllers\Front\FrontendController::class, 'studentcontrol1'])->name('front.student-pairing-control1');



    Route::match(['get', 'post'], '/student-after-test', [App\Http\Controllers\Front\student\StudentController::class, 'student_zip_check'])->name('student-after-test');
    Route::match(['get', 'post'], '/student-result', [App\Http\Controllers\Front\student\StudentController::class, 'student_result'])->name('student-result');
    Route::match(['get', 'post'], '/student-result1', [App\Http\Controllers\Front\student\StudentController::class, 'student_result1'])->name('student-result1');

    Route::get('/student-payment', function () {
        return view('front.student.payment');
    });

    Route::get('/student-edit-profile', [App\Http\Controllers\Front\FrontendController::class, 'editProfile'])->name('front.student-edit-profile');
    Route::post('/student-edit-profile', [App\Http\Controllers\Front\FrontendController::class, 'updateProfile'])->name('update.profile');
    Route::match(['get', 'post'], '/student-time-scheduling', [App\Http\Controllers\Front\FrontendController::class, 'student_scheduling1'])->name('front.student.student-time-scheduling');
    Route::get('/student-view-profile', [App\Http\Controllers\Front\FrontendController::class, 'showProfile'])->name('front.student-view-profile');

    Route::match(['get', 'post'], '/student-pairing', [App\Http\Controllers\Front\FrontendController::class, 'studentpairing'])->name('front.student-pairing');

    Route::get('student/stripe-val', [App\Http\Controllers\Front\student\StripeController1::class, 'dstripe'])->name('student.stripe-val');

    Route::post('student/payment', [App\Http\Controllers\Front\student\StripeController::class, 'payment'])->name('student.stripe.post');
    Route::post('student/payment1', [App\Http\Controllers\Front\student\StripeController1::class, 'payment'])->name('student.stripe.post1');

    Route::match(['get', 'post'], 'student/support', [App\Http\Controllers\Front\SupportController::class, 'support'])->name('student.support');

    Route::get('student/pay_bal', [App\Http\Controllers\Front\student\StripeController1::class, 'pay_bal'])->name('student.pay_bal');

    Route::get('student/groupcheck', [App\Http\Controllers\Front\student\StudentController::class, 'groupcheck'])->name('student.groupcheck');

    Route::get('student/merithub',[App\Http\Controllers\Front\student\StudentController::class,'merithub'])->name('student.merithub');

});

// Admin Login
Route::get('admin/login', [App\Http\Controllers\Auth\Admin\LoginController::class, 'login_view'])->name('admin.login');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPassword'])->name('ForgetPasswordGet');
Route::post('forget-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgetPasswordStore'])->name('ForgetPasswordPost');
Route::get('reset-password/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPasswordGet');
Route::post('reset-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPasswordStore'])->name('ResetPasswordPost');

Route::get('/timezone-list', [App\Http\Controllers\Admin\AjaxController::class, 'TimezoneLists'])->name('timezone-list');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['Admin']], function () {
    Route::get('/group-class', [App\Http\Controllers\Admin\StudentController::class, 'GroupIndex'])->name('group-class');

    //action master manage
    Route::post('/enable-action', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction'])->name('enable-action');
    Route::post('/status-action', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction'])->name('status-action');
    Route::post('/delete-action', [App\Http\Controllers\Admin\AjaxController::class, 'setDeleteAction'])->name('delete-action');
    Route::post('/status-action', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction'])->name('status-action');
    Route::post('/status-action1', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction1'])->name('status-action1');
    Route::post('/status-action2', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction2'])->name('status-action2');
    //status/delete////
    //   Route::post('/enable-action', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction'])->name('enable-action');
    //   Route::post('/status-action', [App\Http\Controllers\Admin\AjaxController::class, 'setStatusAction'])->name('status-action');
    //   Route::post('/delete-action', [App\Http\Controllers\Admin\AjaxController::class, 'setDeleteAction'])->name('delete-action');
    // Route::post('/enable-action1', [App\Http\Controllers\Admin\AjaxController::class, 'setEnableAction1'])->name('enable-action1');
    ///////Role permission/////
    Route::get('/role', [App\Http\Controllers\Admin\RoleController::class, 'index'])->name('role');
    Route::match(['get', 'post'], '/role/create', [App\Http\Controllers\Admin\RoleController::class, 'create'])->name('role.create');
    Route::match(['get', 'post'], '/role/edit/{id}', [App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('role.edit');
    Route::get('/role-permission/{id}', [App\Http\Controllers\Admin\RoleController::class, 'getAddPermissionPage'])->name('role.permission');
    Route::post('/role-permission/update', [App\Http\Controllers\Admin\RoleController::class, 'updateRolePermission'])->name('role.permission');

    //state
    Route::get('/state', [App\Http\Controllers\Admin\StateController::class, 'index'])->name('state');
    Route::match(['get', 'post'], '/state/create', [App\Http\Controllers\Admin\StateController::class, 'create'])->name('state.create');
    Route::match(['get', 'post'], '/state/edit/{id}', [App\Http\Controllers\Admin\StateController::class, 'edit'])->name('state.edit');
    /////////////City
    Route::get('/city', [App\Http\Controllers\Admin\CityController::class, 'index'])->name('city');
    Route::match(['get', 'post'], '/city/create', [App\Http\Controllers\Admin\CityController::class, 'create'])->name('city.create');
    Route::match(['get', 'post'], '/city/edit/{id}', [App\Http\Controllers\Admin\CityController::class, 'edit'])->name('city.edit');
    /////////////////////timezone////////////
    Route::get('/time_zones', [App\Http\Controllers\Admin\TimeZoneController::class, 'index'])->name('time_zones');
    Route::match(['get', 'post'], '/time_zones/create', [App\Http\Controllers\Admin\TimeZoneController::class, 'create'])->name('time_zones.create');
    Route::match(['get', 'post'], '/time_zones/edit/{id}', [App\Http\Controllers\Admin\TimeZoneController::class, 'edit'])->name('time_zones.edit');
    ////////////////////question/////////
    Route::get('/zipcode', [App\Http\Controllers\Admin\ZipCodeController::class, 'index'])->name('zipcode');
    Route::match(['get', 'post'], '/zipcode/create', [App\Http\Controllers\Admin\ZipCodeController::class, 'create'])->name('zipcode.create');
    Route::match(['get', 'post'], '/zipcode/edit/{id}', [App\Http\Controllers\Admin\ZipCodeController::class, 'edit'])->name('zipcode.edit');
    ////////////////////question/////////
    Route::get('/questions', [App\Http\Controllers\Admin\QuestionController::class, 'index'])->name('questions');
    Route::match(['get', 'post'], '/questions/create', [App\Http\Controllers\Admin\QuestionController::class, 'create'])->name('questions.create');
    Route::match(['get', 'post'], '/questions/edit/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'edit'])->name('questions.edit');
    Route::match(['get', 'post'], '/questions/add_option/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'add_option'])->name('questions.add_option');
    Route::get('/questions/view/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'view'])->name('questions.view');
    Route::match(['get', 'post'], '/questions/edit_option/{id}', [App\Http\Controllers\Admin\QuestionController::class, 'edit_option'])->name('questions.edit_option');
    ////////////////////////Courses///////////////////////////////
    Route::get('/courses', [App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses');
    Route::match(['get', 'post'], '/courses/create', [App\Http\Controllers\Admin\CourseController::class, 'create'])->name('courses.create');
    Route::match(['get', 'post'], '/courses/edit/{id}', [App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('courses.edit');
    ////////////payment/////////////
    Route::get('/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments');
    Route::match(['get', 'post'], '/payments/create', [App\Http\Controllers\Admin\PaymentController::class, 'create'])->name('payments.create');
    Route::match(['get', 'post'], '/payments/edit/{id}', [App\Http\Controllers\Admin\PaymentController::class, 'edit'])->name('payments.edit');
    //////////////////////question option
    Route::match(['get', 'post'], '/question_options/edit/{id}', [App\Http\Controllers\Admin\QuestionOptionController::class, 'edit'])->name('question_options.edit');

    //dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('dashboard');
    //USER CONTROLLER
    Route::get('/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('user');
    Route::match(['get', 'post'], '/user/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('user.create');
    Route::match(['get', 'post'], '/user/edit/{id}', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('user.edit');
    //user-permission
    Route::get('/user-permission', [App\Http\Controllers\Admin\UserPermissionController::class, 'index'])->name('user-permission');
    Route::get('/permission', [App\Http\Controllers\Admin\UserPermissionController::class, 'getAddPermissionPage'])->name('permission');
    Route::post('/role-permission/update', [App\Http\Controllers\Admin\UserPermissionController::class, 'updateRolePermission'])->name('role.permission');
    ////////////////////////student register/////////////
    Route::get('/students', [App\Http\Controllers\Admin\StudentController::class, 'index'])->name('students');
    Route::match(['get', 'post'], '/students/create', [App\Http\Controllers\Admin\StudentController::class, 'create'])->name('students.create');
    Route::match(['get', 'post'], '/students/edit/{id}', [App\Http\Controllers\Admin\StudentController::class, 'edit'])->name('students.edit');

    Route::get('/t_list', [App\Http\Controllers\Admin\StudentController::class, 't_list'])->name('t_list');
    Route::post('/pairings', [App\Http\Controllers\Admin\StudentController::class, 'pairings'])->name('pairings');

    /////////////////////teacher//////////////
    Route::get('/teachers', [App\Http\Controllers\Admin\TeacherController::class, 'index'])->name('teachers');
    Route::match(['get', 'post'], '/teachers/create', [App\Http\Controllers\Admin\TeacherController::class, 'create'])->name('teachers.create');
    Route::match(['get', 'post'], '/teachers/edit/{id}', [App\Http\Controllers\Admin\TeacherController::class, 'edit'])->name('teachers.edit');

    Route::get('/email', [App\Http\Controllers\Admin\EmailTemplateController::class, 'index'])->name('email');
    Route::match(['get', 'post'], '/email/create', [App\Http\Controllers\Admin\EmailTemplateController::class, 'create'])->name('email.create');
    Route::match(['get', 'post'], '/email/edit/{id}', [App\Http\Controllers\Admin\EmailTemplateController::class, 'edit'])->name('email.edit');

    Route::match(['get', 'post'], '/support', [App\Http\Controllers\Admin\SupportController::class, 'index'])->name('support');
    Route::match(['get', 'post'], '/finish-current-course', [App\Http\Controllers\Admin\FinishCourseController::class, 'index'])->name('finish-current-course');

    Route::match(['get', 'post'], '/batch', [App\Http\Controllers\Admin\SupportController::class, 'index1'])->name('batch');

    Route::match(['get', 'post'], '/ImportData', [App\Http\Controllers\Admin\StudentController::class, 'ImportData'])->name('ImportData');

});

Route::match(['get', 'post'], '/teacher-signup', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher'])->name('teacher.teacher-signup');
Route::match(['get', 'post'], '/teacher-submit', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_submit'])->name('teacher.teacher-submit');
Route::match(['get', 'post'], '/teacher-verify/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_verify'])->name('teacher.teacher-verify');
Route::match(['get', 'post'], '/student-verify/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'student_verify'])->name('student.teacher-verify');



Route::group(['middleware' => ['Teacher']], function () {

    Route::match(['get', 'post'], '/teacher-after-test', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_after_check'])->name('teacher-after-test');
    Route::match(['get', 'post'], '/teacher-signup-register/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_survey'])->name('teacher.teacher-signup-register');
    Route::match(['get', 'post'], '/teacher-review/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_review'])->name('teacher.teacher-review');
    Route::match(['get', 'post'], '/resend-email/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'resend_email'])->name('teacher.resend-email');
    Route::match(['get', 'post'], '/teacher-zip-check/{id}', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teacher_zip_check'])->name('teacher.teacher-zip-check');
    Route::match(['get', 'post'], '/teacher-pairing-control', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teachercontrol'])->name('teacher.teacher-pairing-control');
    Route::match(['get', 'post'], '/teacher-support', [App\Http\Controllers\Front\teacher\FrontendController::class, 'teachersupport'])->name('teacher.teacher-support');
    Route::match(['get', 'post'], '/st-data-details', [App\Http\Controllers\Front\teacher\FrontendController::class, 'stdetails'])->name('teacher.st-data-details');
    Route::match(['get', 'post'], '/teacher_pairing', [App\Http\Controllers\Front\teacher\TeacherController::class, 'teacher_pairing'])->name('teacher.teacher_pairing');
    Route::match(['get', 'post'], '/finish-course', [App\Http\Controllers\Front\teacher\TeacherController::class, 'finish_course'])->name('teacher.finish-course');
    Route::match(['get', 'post'], 'teacher/support', [App\Http\Controllers\Front\SupportController::class, 'support'])->name('teacher.support');

    Route::match(['get', 'post'], '/teacher-change-password', [App\Http\Controllers\PasswordChangeController::class, 'teacherchangepass'])->name('front.teacher.teacher-change-password');
    Route::post('/change-password', [App\Http\Controllers\PasswordChangeController::class, 'changePassword1'])->name('teacher.password.update');
    //////////////////edit profile/////////
    Route::get('/teacher-edit-profile', [App\Http\Controllers\Front\teacher\FrontendController::class, 'editProfile'])->name('front.teacher.teacher-edit-profile');
    Route::post('/teacher-edit-profile', [App\Http\Controllers\Front\teacher\FrontendController::class, 'updateProfile'])->name('teacher.update.profile');
    Route::get('/teacher-view-profile', [App\Http\Controllers\Front\teacher\FrontendController::class, 'showProfile'])->name('front.teacher.teachergd-view-profile');

    Route::get('teacher/merithub', [App\Http\Controllers\Front\teacher\TeacherController::class, 'merithub'])->name('teacher.merithub');

    Route::get('teacher/filter', [App\Http\Controllers\Front\teacher\TeacherController::class, 'StudentFilter'])->name('teacher.filter');
    Route::match(['get', 'post'], '/teacher-student-list', [App\Http\Controllers\Front\teacher\TeacherController::class, 'studentlist'])->name('teacher.teacher-student-list');

});
Route::get('logout', [App\Http\Controllers\Auth\Admin\LoginController::class, 'logout'])->name('admin.logout');

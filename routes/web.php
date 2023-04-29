<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemoController;
use App\Http\Controllers\PVController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LogisticController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StockrequestController;
use App\Http\Controllers\TaskController;


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

Route::get('/', function () {
    return view('auth.login');
});

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

Route::get('/dashboard', [HomeController::class, 'dashboard']);

require __DIR__ . '/auth.php';









/**************************** BEGINIG OF Category Controller **************************************/


// Route::post('/itask/store', [TaskController::class, 'store']);

// Route::get('/stock/{stock}/show', [StockController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categorycreate', [CategoryController::class, 'create']);

//  show the edit;
Route::get('/category/{category}', [CategoryController::class, 'edit']);




// Create New Stock
Route::post('/category', [CategoryController::class, 'store']);

// Edit New Stock
Route::put('/category/{category}', [CategoryController::class, 'update']);
Route::delete('/category/{category}', [CategoryController::class, 'destroy']);




/**************************** END OF TASK Controller **************************************/









/*************************** Profile Controller ********************************/

Route::get('/createstaff', [ProfileController::class, 'createstaff']);

Route::get('/profilepics', [ProfileController::class, 'profilepics']);

Route::get('/addsignature', [ProfileController::class, 'addsignature']);

Route::get('/designations', [ProfileController::class, 'designations']);

Route::get('/showdesignations', [ProfileController::class, 'showdesignations']);

Route::get('/departments', [ProfileController::class, 'departments']);

Route::get('/deletedepartment', [ProfileController::class, 'deletedepartment']);

Route::get('/deletedesignation', [ProfileController::class, 'deletedesignation']);

Route::post('/submitdepartment', [ProfileController::class, 'submitdepartment']);

Route::get('/offices', [ProfileController::class, 'offices']);

Route::get('/deleteoffice', [ProfileController::class, 'deleteoffice']);

Route::get('/banks', [ProfileController::class, 'banks']);

Route::get('/deletebank', [ProfileController::class, 'deletebank']);

Route::get('/staffprofile', [ProfileController::class, 'staffprofile']);

Route::post('/submitdesignation', [ProfileController::class, 'submitdesignation']);

Route::post('/submitoffices', [ProfileController::class, 'submitoffices']);

Route::post('/submitbank', [ProfileController::class, 'submitbank']);

Route::post('/submitstaff', [ProfileController::class, 'submitstaff']);

Route::post('/submitpics', [ProfileController::class, 'submitpics']);

Route::post('/submitsignature', [ProfileController::class, 'submitsignature']);

Route::get('/editstaff', [ProfileController::class, 'editstaff']);

Route::get('/convertuser', [ProfileController::class, 'convertuser']);

Route::post('/submiteditstaff', [ProfileController::class, 'submiteditstaff']);

Route::get('/stafftable', [ProfileController::class, 'stafftable']);

Route::get('/usertable', [ProfileController::class, 'usertable']);

Route::get('/userprofile', [ProfileController::class, 'userprofile']);

Route::post('/submitedituser', [ProfileController::class, 'submitedituser']);

Route::get('/updateprofile', [ProfileController::class, 'updateprofile']);

Route::post('/submitupdateprofile', [ProfileController::class, 'submitupdateprofile']);

Route::get('/uploadmypics', [ProfileController::class, 'uploadmypics']);

Route::get('/uploadmysignature', [ProfileController::class, 'uploadmysignature']);

Route::post('/submitmypics', [ProfileController::class, 'submitmypics']);

Route::post('/submitmysignature', [ProfileController::class, 'submitmysignature']);

Route::get('/changepassword', [ProfileController::class, 'changepassword']);

Route::post('/submitpassword', [ProfileController::class, 'submitpassword']);

/**************************** BEGINIG OF Logistics Route **************************************/


Route::get('/logistics', [LogisticController::class, 'index']);

Route::get('/logisticrequest', [LogisticController::class, 'myindex']);
Route::get('/editlogistic{logistic}', [LogisticController::class, 'edit']);
Route::get('/logisticcreate', [LogisticController::class, 'create']);
Route::post('/logistics', [LogisticController::class, 'store']);
Route::get('/logistic{logistic}', [LogisticController::class, 'show']);
Route::delete('/logistic/{logistic}', [LogisticController::class, 'destroy']);
Route::put('/logistic/edit/{logistic}', [LogisticController::class, 'update']);
Route::put('/logistic/treat/{logistic}', [LogisticController::class, 'updatetreat']);

/**************************** ENDING OF Logistics Route **************************************/




/**************************** STARTING OF BUDGET Route **************************************/
//create budget
Route::post('/budgetcreate', [BudgetController::class, 'store']);

// all budgets
Route::get('/budgets', [BudgetController::class, 'index']);
// all of my budgets
Route::get('/mybudgets', [BudgetController::class, 'myindex']);
// show details of my budget
Route::get('/showmybudget{budget}', [BudgetController::class, 'show']);
// show details of budget for treat
Route::get('/showbudget{budget}', [BudgetController::class, 'show2']);

// delete budget
Route::delete('/budget/{budget}', [BudgetController::class, 'destroy']);

//create budget
Route::get('/budgetcreate', [BudgetController::class, 'create']);

//showeditpage
Route::get('/editbudget{budget}', [BudgetController::class, 'edit']);

//showeditpage
Route::put('/editbudget{budget}', [BudgetController::class, 'update']);


//showeditpage
Route::put('/treatbudget{budget}', [BudgetController::class, 'updatetreat']);

//showeditpage
Route::put('/bugetdisburse{budget}', [BudgetController::class, 'updatedisburse']);


/**************************** Ending  OF BUDGET route **************************************/


/**************************** STARTING OF TRAINING Route **************************************/

//create budget
Route::get('/trainingcreate', [BuildingController::class, 'create']);
Route::post('/trainingcreate', [BuildingController::class, 'store']);
Route::get('/mytrainings', [BuildingController::class, 'myindex']);
Route::get('/trainings', [BuildingController::class, 'index']);
Route::get('/showmytraining{training}', [BuildingController::class, 'show']);
Route::get('/showtraining{training}', [BuildingController::class, 'show2']);
Route::get('/edittraining{training}', [BuildingController::class, 'edit']);


/**************************** Ending  OF BUDGET route **************************************/








/**************************** BEGINIG OF PROJECT Controller **************************************/

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/personal', [ProjectController::class, 'personal']);
Route::get('/project/create', [ProjectController::class, 'create']);
Route::get('/project/{project}/task/create', [ProjectController::class, 'createtask']);

Route::get('/project/{project}', [ProjectController::class, 'show']);
Route::delete('/project/{project}', [ProjectController::class, 'destroy']);
Route::post('/projects', [ProjectController::class, 'store']);
/**************************** END OF PROJECT Controller **************************************/





/**************************** BEGINIG OF Procurement Controller **************************************/


// Route::post('/itask/store', [TaskController::class, 'store']);

// Route::get('/stock/{stock}/show', [StockController::class, 'show']);
Route::get('/procurementedit{procurement}', [ProcurementController::class, 'edit']);
Route::put('/procurementedit{procurement}', [ProcurementController::class, 'update']);
Route::get('/procurements', [ProcurementController::class, 'index']);
Route::get('/myprocurements', [ProcurementController::class, 'myindex']);
Route::get('/procurementcreate', [ProcurementController::class, 'create']);
Route::post('/procurements', [ProcurementController::class, 'store']);
Route::get('/procurement{procurement}', [ProcurementController::class, 'show']);
Route::post('/procurement{procurement}', [ProcurementController::class, 'treat']);
Route::delete('/procurement/{procurement}', [ProcurementController::class, 'destroy']);








/**************************** Start  OF Stock Request Controller **************************************/

Route::get('/mystockrequest', [StockrequestController::class, 'myindex']);
Route::put('/mystockrequestedit{request}', [StockrequestController::class, 'update']);
Route::get('/mystockrequestedit{request}', [StockrequestController::class, 'edit']);

Route::get('/mystockrequest{request}', [StockrequestController::class, 'myshow']);
Route::delete('/mystockrequest{request}', [StockrequestController::class, 'destroy']);
Route::put('/mystockrequest{request}', [StockrequestController::class, 'disburse']);



Route::post('/stockrequestcreate', [StockrequestController::class, 'store']);
Route::get('/stockrequestcreate', [StockrequestController::class, 'create']);




Route::get('/stockrequestlisttreat{request}', [StockrequestController::class, 'treat']);

Route::post('/stockrequestlisttreat{request}', [StockrequestController::class, 'updatetreat']);
Route::get('/stockrequestlisttreat', [StockrequestController::class, 'stockrequestlisttreat']);
Route::get('/stockrequest{request}', [StockrequestController::class, 'show']);
Route::get('/stockrequest', [StockrequestController::class, 'index']);


/**************************** End  OF Stock Request Controller **************************************/

/**************************** BEGINIG OF Stocl Controller **************************************/


// Route::post('/itask/store', [TaskController::class, 'store']);

// Route::get('/stock/{stock}/show', [StockController::class, 'show']);
Route::get('/stocks', [StockController::class, 'index']);
Route::get('/stockcreate', [StockController::class, 'create']);

Route::get('/stockedit{stock}', [StockController::class, 'edit']);
Route::get('/stock{stock}', [StockController::class, 'show']);

Route::put('/stock/edit/{stock}', [StockController::class, 'update']);
Route::delete('/stock/{stock}', [StockController::class, 'destroy']);

// Create New Stock
Route::post('/stocks', [StockController::class, 'store']);
// Route::put('/stock/{task}', [StockController::class, 'update']);
// Route::put('/project/move/task/{task}', [StockController::class, 'update_status']);
// Route::delete('/project/task/{task}', [TaskController::class, 'destroy']);



/**************************** END OF TASK Controller **************************************/









/**************************** BEGINIG OF TASK Controller **************************************/


Route::post('/itask/store', [TaskController::class, 'store']);

Route::get('/task/{task}/show', [TaskController::class, 'show']);

Route::put('/project/task/{task}', [TaskController::class, 'update']);
Route::put('/project/move/task/{task}', [TaskController::class, 'update_status']);
Route::delete('/project/task/{task}', [TaskController::class, 'destroy']);



/**************************** END OF TASK Controller **************************************/










/*************************** Memo Controller *************************************/

Route::get('/creatememo', [MemoController::class, 'creatememo']);

Route::get('/memodetails', [MemoController::class, 'memodetails']);

Route::get('/memoinbox', [MemoController::class, 'memoinbox']);

Route::get('/sentmemo', [MemoController::class, 'sentmemo']);

Route::get('/allmemo', [MemoController::class, 'allmemo']);

Route::post('/submitmemo', [MemoController::class, 'submitmemo']);

Route::post('/memoreaction', [MemoController::class, 'memoreaction']);

Route::post('/submiteditmemo', [MemoController::class, 'submiteditmemo']);

Route::get('/editmemo', [MemoController::class, 'editmemo']);


/**************************** PV Controller **************************************/

Route::get('/paymentvoucher', [PVController::class, 'paymentvoucher']);

Route::get('/pvdetails', [PVController::class, 'pvdetails']);

Route::get('/allpvs', [PVController::class, 'allpvs']);

Route::post('submitpv', [PVController::class, 'submitpv']);

Route::post('submiteditpv', [PVController::class, 'submiteditpv']);

Route::post('submitpvstatus', [PVController::class, 'submitpvstatus']);

Route::get('editpv', [PVController::class, 'editpv']);

Route::get('sentpvs', [PVController::class, 'sentpvs']);


/*************************** Circular Controller *********************************/

Route::get('/createcircular', [CircularController::class, 'createcircular']);

Route::get('/circulardetails', [CircularController::class, 'circulardetails']);

Route::get('/listcirculars', [CircularController::class, 'listcirculars']);

Route::post('submitcircular', [CircularController::class, 'submitcircular']);

Route::post('submitcircularstatus', [CircularController::class, 'submitcircularstatus']);

Route::get('/mycirculars', [CircularController::class, 'mycirculars']);


/**************************** Role Privileges *************************************/

Route::get('/actions', [AccessController::class, 'actions']);

Route::get('/deleteaction', [AccessController::class, 'deleteaction']);

Route::post('/submiaction', [AccessController::class, 'submiaction']);

Route::get('/process', [AccessController::class, 'process']);

Route::get('/deleteprocess', [AccessController::class, 'deleteprocess']);

Route::post('/submitprocess', [AccessController::class, 'submitprocess']);

Route::get('/roles', [AccessController::class, 'roles']);

Route::get('/deleterole', [AccessController::class, 'deleterole']);

Route::post('/submitrole', [AccessController::class, 'submitrole']);

Route::get('/privileges', [AccessController::class, 'privileges']);

Route::post('/submitprivileges', [AccessController::class, 'submitprivileges']);

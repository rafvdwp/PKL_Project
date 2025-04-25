<?php

use App\Http\Controllers\AdminManageBulkMaterial;
use App\Http\Controllers\PrintToPDF;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSummation;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AdminUnitController;
use App\Http\Controllers\subSystemController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\AdminManageSpecification;
use App\Http\Controllers\AdminsubSystemController;
use App\Http\Controllers\AdminSpecificationController;
use App\Http\Controllers\subSystemDescriptionController;
use App\Http\Controllers\AdminsubSystemDescriptionController;
use App\Http\Controllers\SpecificationBulkMaterialController;
use App\Http\Controllers\AdminManageSpecificationBulkMaterial;
use App\Http\Controllers\AdminSpecificationBulkMaterialController;


Route::middleware('user')->group(
    function () {
// User view Index Project
Route::get('user/project', [ProjectController::class, 'index'])->name('project.index');
Route::get('user/print', [ProjectController::class, 'print'])->name('project.print');
Route::post('user/project/store', [ProjectController::class, 'store'])->name('project.store');
Route::get('user/project/create', [ProjectController::class, 'create'])->name('project.create');

// User View Show Project
Route::get('user/project/{project}/edit', [ProjectController::class, 'edit'])->name('project.edit');
Route::get('user/project/{project}', [ProjectController::class, 'show'])->name('project.show');
Route::get('user/project/{project}/delete', [ProjectController::class, 'delete'])->name('subsystem.delete');

//User VIew ShowSystem
Route::get('/user/project/{project}/subSystem/{subSystem}', [ProjectController::class, 'showsubSystem'])->name('project.subSystem');
Route::get('/user/project/{project}/subSystem/{subSystem}/delete', [ProjectController::class, 'deleteDescription'])->name('project.description.delete');
Route::get('user/project/{project}/subSystem/create', [subSystemController::class, 'create'])->name('subSystem.create');
Route::post('user/project/{project}/subSystem', [subSystemController::class, 'store'])->name('subSystem.store');
Route::post('/user/project/{project}/subSystem/{subSystem}/Descriptions', [subSystemDescriptionController::class, 'store'])->name('subSystemDescription.store');
Route::post('user/project/{project}/subSystem/{subSystem}/specification', [SpecificationController::class, 'store'])->name('specification.store');
Route::post('/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification', [SpecificationController::class, 'store'])->name('specification.store');
Route::put('user/project/{project}/subSystem/{subSystem}/edit', [ProjectController::class, 'subSystemedit'])->name('project.subSystem.edit');

// bulk material
Route::get('user/project/{project}/subSystem/{subSystem}/showsubSystembulkmaterial', [ProjectController::class, 'showsubSystemBulkMaterial'])->name('project.subSystembulkmaterial');
Route::post('user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial', [SpecificationBulkMaterialController::class, 'store'])->name('specificationbulkmaterial.store');
Route::put('user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial', [SpecificationbulkmaterialController::class, 'update'])->name('specificationbulkmaterial.update');
Route::get('user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial/delete', [SpecificationbulkmaterialController::class, 'delete'])->name('specificationbulkmaterial.delete');
    }
);

//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//


// Routes untuk kedua role (admin dan user)
Route::middleware('both.roles')->group(function () {
// copy fiture
Route::post('/project/{project}/copy', [AdminProjectController::class, 'copyProject'])->name('project.copy');
// export excel fiture
Route::get('admin/export/specification/budgetary/{id}', [ExportController::class, 'exportSpecification_budgetary'])->name('export.specification.budgetary');
Route::get('admin/export/specification/bulk_material/{id}', [ExportController::class, 'exportSpecification_bulk_material'])->name('export.specification.bulk_material');
// searchlist fiture
Route::get('/searchlist', [ProjectController::class, 'searchlist'])->name('searchlist');
// summary fiture
Route::get('admin/summation/{projectId}', [AdminSummation::class, 'index'])->name('admin.summation');
// Print PDF fiture
Route::get('admin/printthree/{projectId}', [PrintToPDF::class, 'indexthree'])->name('admin.printthree');

Route::put('admin/printthree/{projectId}/image/{id}', [PrintToPDF::class, 'updateImage'])
    ->name('admin.printthree.updateImage');
    

Route::post('admin/printthree/{projectId}/imgstore', [PrintToPDF::class, 'ImgStore'])->name('admin.printthree.ImgStore');
Route::post('admin/printthree/{projectId}/TablePDFOneStore', [PrintToPDF::class, 'TablePDFOneStore'])->name('admin.printthree.TablePDFOneStore');
Route::post('admin/printthree/{projectId}/TablePDFTwoStore', [PrintToPDF::class, 'TablePDFTwoStore'])->name('admin.printthree.TablePDFTwoStore');
Route::post('admin/printthree/{projectId}/TablePDFThreeStore', [PrintToPDF::class, 'TablePDFThreeStore'])->name('admin.printthree.TablePDFThreeStore');
Route::post('admin/printthree/{projectId}/TablePDFFooterStore', [PrintToPDF::class, 'TablePDFFooterStore'])->name('admin.printthree.TablePDFFooterStore');


Route::post('admin/printthree/{projectId}/TableOneFillStore', [PrintToPDF::class, 'TableOneFillStore'])->name('admin.printthree.TableOneFillStore');
Route::post('admin/printthree/{projectId}/TableTwoFillStore', [PrintToPDF::class, 'TableTwoFillStore'])->name('admin.printthree.TableTwoFillStore');
Route::post('admin/printthree/{projectId}/TableThreeFillStore', [PrintToPDF::class, 'TableThreeFillStore'])->name('admin.printthree.TableThreeFillStore');
// Search ManageProject
Route::get('admin/project/management/manageProject/search', [AdminProjectController::class, 'search'])->name('admin.project.search');





});



//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//-------------------//

Route::middleware('admin')->group(
    function () {
// Admin Management
Route::get('admin/project/user/management', [AdminProjectController::class, 'adminUserManage'])->name('admin.project.userManage');
Route::get('admin/project/management/manageProject', [AdminProjectController::class, 'manageProject'])->name('admin.project.manageProject');
Route::delete('admin/project/management/manageProject/delete/{project}', [AdminProjectController::class, 'manageProjectDestroy'])->name('admin.project.manageUsers.destroy');
Route::get('admin/project/management/manageDescription', [AdminsubSystemController::class, 'manageDescription'])->name('admin.project.manageDescription');
Route::get('admin/project/management/manageDescription/delete/{id}', [AdminsubSystemController::class, 'manageDescriptionDelete'])->name('admin.project.manageDescription.delete');

Route::get('admin/project/management/subSystem', [AdminProjectController::class, 'adminManagesubSystem'])->name('admin.project.managesubSystem');
Route::post('admin/project/management/subSystem/store', [AdminsubSystemController::class, 'adminManagesubSystemstore'])->name('admin.project.managesubSystem.store');
Route::delete('admin/project/management/subSystem/{id}', [AdminsubSystemController::class, 'adminDelete'])->name('admin.project.managesubSystem.delete');

Route::get('admin/project/management/manageBulkMaterial', [AdminManageBulkMaterial::class, 'index'])->name('admin.project.manageBulkMaterial');

Route::post('admin/management/DetailSpecification/Store', [AdminManageSpecification::class, 'DetailSpecificationStore'])->name('admin.manageSpecification.DetailSpecificationStore');
Route::GET('admin/management/DetailSpecification/delete/{id}', [AdminManageSpecification::class, 'DetailSpecificationDelete'])->name('admin.manageSpecification.DetailSpecificationDelete');

Route::get('admin/management/specification/index', [AdminManageSpecification::class, 'index'])->name('admin.manageSpecification.index');
Route::post('admin/management/specification', [AdminManageSpecification::class, 'store'])->name('admin.manageSpecification.store');
Route::get('admin/management/specification/index/delete/{id}', [AdminManageSpecification::class, 'delete'])->name('admin.manageSpecification.delete');
Route::get('admin/get-Descriptions/{subSystem}', [AdminManageSpecification::class, 'getDescriptions'])->name('admin.getDescriptions');

Route::get('admin/management/specificationbulkmaterial/index', [AdminManageSpecificationBulkMaterial::class, 'index'])->name('admin.manageSpecificationbulkmaterial.index');
Route::get('admin/management/specificationbulkmaterial/index/delete/{id}', [AdminManageSpecificationBulkMaterial::class, 'delete'])->name('admin.manageSpecificationbulkmaterial.delete');
Route::post('admin/management/user/specificationbulkmaterial', [AdminManageSpecificationBulkMaterial::class, 'store'])->name('admin.manageSpecificationbulkmaterial.store');

Route::get('admin/project/management/unit', [AdminUnitController::class, 'index'])->name('admin.manageUnit');
Route::post('admin/project/management/unit/store', [AdminUnitController::class, 'store'])->name('admin.manageUnit.store');
Route::post('admin/project/management/size/store', [AdminUnitController::class, 'SizeStore'])->name('admin.manageUnit.SizeStore');
Route::get('admin/project/management/unit/delete/{id}', [AdminUnitController::class, 'delete'])->name('admin.manageUnit.delete');
Route::get('admin/project/management/size/delete/{id}', [AdminUnitController::class, 'SizeDelete'])->name('admin.manageUnit.SizeDelete');

// Admin View Index
Route::get('admin/index', [AdminProjectController::class, 'indexAdmin'])->name('admin.index');
Route::delete('admin/project/{project}', [AdminProjectController::class, 'destroy'])->name('admin.project.destroy');
Route::post('admin/project/subSystemDescription/delete/{id}', [AdminsubSystemDescriptionController::class, 'destroy'])->name('admin.subSystemDescription.delete');
Route::post('admin/project/subSystemDescription/store', [AdminsubSystemDescriptionController::class, 'store'])->name('admin.subSystemDescription.store');
Route::post('admin/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification/{Description_name}', [AdminProjectController::class, 'getSpecification'])->name('specification.index');
Route::post('admin/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification/{Description_name}/bulkmaterial', [AdminProjectController::class, 'getSpecificationBulkMaterial'])->name('specification.indexbulkmaterial');



Route::put('admin/user/project/{project}/subSystem/{subSystem}/edit', [AdminProjectController::class, 'subSystemedit'])->name('admin.project.subSystem.edit');
Route::get('admin/user/management/project/{id}', [AdminProjectController::class, 'destroyUsers'])->name('admin.project.destroyusers');

// Admin Route    
Route::get('admin/user/project/create', [AdminProjectController::class, 'create'])->name('admin.project.create');
Route::post('admin/user/project/store', [AdminProjectController::class, 'store'])->name('admin.project.store');
Route::get('admin/user/project', [AdminProjectController::class, 'index'])->name('admin.project.index');

Route::get('admin/user/project/{project}/edit', [AdminProjectController::class, 'edit'])->name('admin.project.edit');
Route::put('admin/user/project/{project}', [AdminProjectController::class, 'update'])->name('admin.project.update');
Route::get('admin/user/project/{project}', [AdminProjectController::class, 'show'])->name('admin.project.show');
Route::get('admin/user/project/{project}/subSystem/{subSystem}', [AdminProjectController::class, 'showsubSystem'])->name('admin.project.subSystem');

Route::get('admin/user/project/{project}/subSystem/create', [AdminsubSystemController::class, 'create'])->name('admin.subSystem.create');
Route::post('admin/user/project/{project}/subSystem', [AdminsubSystemController::class, 'store'])->name('admin.subSystem.store');
Route::post('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification', [AdminSpecificationController::class, 'store'])->name('admin.specification.store');
Route::put('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification', [AdminSpecificationController::class, 'update'])->name('admin.specification.update');
Route::get('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specification/delete', [AdminSpecificationController::class, 'delete'])->name('admin.project.specification.delete');
// bulk material
Route::get('admin/user/project/{project}/subSystem/{subSystem}/showsubSystembulkmaterial', [AdminProjectController::class, 'showsubSystemBulkMaterial'])->name('admin.project.subSystembulkmaterial');
Route::post('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial', [AdminSpecificationBulkMaterialController::class, 'store'])->name('admin.specificationbulkmaterial.store');
Route::put('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial', [AdminSpecificationbulkmaterialController::class, 'update'])->name('admin.specificationbulkmaterial.update');
Route::get('admin/user/project/{project}/subSystem/{subSystem}/subSystemDescription/{subSystemDescription}/specificationbulkmaterial/delete', [AdminSpecificationbulkmaterialController::class, 'delete'])->name('admin.specificationbulkmaterial.delete');
    }
);

// Login -> Registar Route
Route::get('/registar', [LoginController::class, 'registar'])->name('registar');
Route::post('/registar-proses', [LoginController::class, 'registar_proses'])->name('registar-proses');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

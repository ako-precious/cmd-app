<?php
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store']);
// Route::post('/posts', function (Request $request) {
//     return Post::create([
//         'title' => 'What is html',
//         'category'=> 'Html',
//         'body'   => 'Structured documents generally focus on labeling things that can be used for a variety of processing purposes, not merely formatting. For example, explicit labeling of "chapter title" or "emphasis" is far more useful to systems for the visually impaired, than merely "Helvetica bold 24" or "italic". In the same way, meaningful labeling of the many items on a technical information sheet enables far better integration with databases, search systems, online catalogs, and so on.
// Structured documents generally support at least hierarchical structures, for example lists, not merely list items; sections, not merely section headings; and so on. This is in stark contrast to formatting-oriented systems. High-end systems also support multiple independent and/or overlapping sets of components.
// Structured document systems commonly permit creating explicit rules defining component types and how they may be combined. Such a set of rules is called a "schema" by analogy with database schemas. Several formal languages exist for specifying them, such as XSD, Relax NG, and Schematron. A structured document which obeys the rules of the schema is commonly called "valid according to that schema". Some systems also support documents with component of arbitrary types and combinations, but still with syntactic rules for how those components are identified.',
//         'status' => 'Published',
//         'user'=>  'AKO'
//         ]);
// });
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

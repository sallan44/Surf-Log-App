<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpotController;
use App\Http\Controllers\SurfSessionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FeedController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('feed', [FeedController::class, 'index'])->name('feed');

Route::middleware('auth')->group(function () {
    Route::resource('spots', SpotController::class);
    Route::resource('boards', BoardController::class);
    Route::resource('tags', TagController::class);
    Route::resource('sessions', SurfSessionController::class)->parameters(['sessions' => 'surf_session']); //Laravel's implicit route-model-binding matches the URI segment name to controller method's parameter name

});

require __DIR__.'/auth.php';


//     //--------------------------------------------------
//     // Spots
//     //--------------------------------------------------

//     // List: every public spot, plus this user's own private ones
//     Route::get('spot_list', function () {
//         $sql = "select * from spots where is_private = 0 or user_id = ? order by name asc";
//         $spots = DB::select($sql, array(auth()->id()));
//         return view('spots.spot_list')->with('spots', $spots);
//     });

//     // Detail: block viewing someone else's private spot, even by guessed URL
//     Route::get('spot_detail/{id}', function ($id) {
//         $spot = get_spot($id);
//         if ($spot->is_private && $spot->user_id != auth()->id()) {
//             abort(403, "This spot is private.");
//         }
//         return view('spots.spot_detail')->with('spot', $spot);
//     });

//     Route::get('add_spot', function () {
//         return view('spots.add_spot');
//     });

//     Route::post('add_spot_action', function () {
//         $validated = request()->validate([
//             'name'        => 'required|string|max:255',
//             'region'      => 'nullable|string|max:255',
//             'latitude'    => 'nullable|numeric|between:-90,90',
//             'longitude'   => 'nullable|numeric|between:-180,180',
//             'description' => 'nullable|string',
//         ]);

//         $id = add_spot(
//             auth()->id(),
//             $validated['name'],
//             $validated['region'] ?? null,
//             $validated['latitude'] ?? null,
//             $validated['longitude'] ?? null,
//             $validated['description'] ?? null,
//             request()->has('is_private') ? 1 : 0
//         );

//         if ($id) {
//             return redirect("spot_detail/$id");
//         }
//         die("Error while adding new spot.");
//     });

//     //--------------------------------------------------
//     // Boards
//     //--------------------------------------------------

//     Route::get('board_list', function () {
//         $sql = "select * from boards where user_id = ? order by name asc";
//         $boards = DB::select($sql, array(auth()->id()));
//         return view('boards.board_list')->with('boards', $boards);
//     });

//     Route::get('board_detail/{id}', function ($id) {
//         $board = get_board($id);
//         if ($board->user_id != auth()->id()) {
//             abort(403, "That's not your board.");
//         }
//         return view('boards.board_detail')->with('board', $board);
//     });

//     Route::get('add_board', function () {
//         return view('boards.add_board');
//     });

//     Route::post('add_board_action', function () {
//         $validated = request()->validate([
//             'name'      => 'required|string|max:255',
//             'type'      => 'nullable|in:shortboard,longboard,fish,gun,other',
//             'length_ft' => 'nullable|numeric|between:4,12',
//         ]);

//         $id = add_board(
//             auth()->id(),
//             $validated['name'],
//             $validated['type'] ?? null,
//             $validated['length_ft'] ?? null
//         );

//         if ($id) {
//             return redirect("board_detail/$id");
//         }
//         die("Error while adding new board.");
//     });

//     //--------------------------------------------------
//     // Sessions
//     //--------------------------------------------------

//     Route::get('session_list', function () {
//         $sql = "select sessions.*, spots.name as spot_name
//                 from sessions
//                 join spots on spots.id = sessions.spot_id
//                 where sessions.user_id = ?
//                 order by sessions.session_date desc";
//         $sessions = DB::select($sql, array(auth()->id()));
//         return view('sessions.session_list')->with('sessions', $sessions);
//     });

//     Route::get('session_detail/{id}', function ($id) {
//         $session = get_session($id);
//         if ($session->user_id != auth()->id()) {
//             abort(403, "That's not your session.");
//         }
//         return view('sessions.session_detail')->with('session', $session);
//     });

//     Route::get('add_session', function () {
//         // spots this user is allowed to log a session at: public ones, or their own private ones
//         $sql = "select * from spots where is_private = 0 or user_id = ? order by name asc";
//         $spots = DB::select($sql, array(auth()->id()));
//         return view('sessions.add_session')->with('spots', $spots);
//     });

//     Route::post('add_session_action', function () {
//         $validated = request()->validate([
//             'spot_id'      => 'required|integer|exists:spots,id',
//             'session_date' => 'required|date|before_or_equal:today',
//             'rating'       => 'required|integer|between:1,5',
//             'wave_count'   => 'nullable|integer|min:0',
//             'notes'        => 'nullable|string',
//         ]);

//         // exists:spots,id only proves the row exists - it doesn't prove this user is allowed to see it.
//         $spot = get_spot($validated['spot_id']);
//         if ($spot->is_private && $spot->user_id != auth()->id()) {
//             return back()->withErrors(['spot_id' => 'You cannot log a session at that spot.'])->withInput();
//         }

//         $id = add_session(
//             auth()->id(),
//             $validated['spot_id'],
//             $validated['rating'],
//             $validated['wave_count'] ?? null,
//             $validated['notes'] ?? null
//         );

//         if ($id) {
//             return redirect("session_detail/$id");
//         }
//         die("Error while adding new session.");
//     });

// });


// //===================================================================
// // FUNCTIONS - SPOTS / BOARDS / SESSIONS
// //===================================================================

// function get_spot($id){
//     $sql = "select * from spots where id = ?";
//     $spots = DB::select($sql, array($id));
//     if (count($spots) != 1){
//         abort(404, "Spot not found.");
//     }
//     return $spots[0];
// }

// function add_spot($userId, $name, $region, $latitude, $longitude, $description, $isPrivate){
//     $sql = "insert into spots (user_id, name, region, latitude, longitude, description, is_private, created_at, updated_at)
//             values (?, ?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))";
//     DB::insert($sql, array($userId, $name, $region, $latitude, $longitude, $description, $isPrivate));
//     return DB::getPdo()->lastInsertId();
// }

// function get_board($id){
//     $sql = "select * from boards where id = ?";
//     $boards = DB::select($sql, array($id));
//     if (count($boards) != 1){
//         abort(404, "Board not found.");
//     }
//     return $boards[0];
// }

// function add_board($userId, $name, $type, $lengthFt){
//     $sql = "insert into boards (user_id, name, type, length_ft, created_at, updated_at)
//             values (?, ?, ?, ?, datetime('now'), datetime('now'))";
//     DB::insert($sql, array($userId, $name, $type, $lengthFt));
//     return DB::getPdo()->lastInsertId();
// }

// function get_session($id){
//     $sql = "select sessions.*, spots.name as spot_name, spots.region as spot_region
//             from sessions
//             join spots on spots.id = sessions.spot_id
//             where sessions.id = ?";
//     $sessions = DB::select($sql, array($id));
//     if (count($sessions) != 1){
//         abort(404, "Session not found.");
//     }
//     return $sessions[0];
// }

// function add_session($userId, $spotId, $date, $rating, $waveCount, $notes){
//     $sql = "insert into sessions (user_id, spot_id, session_date, rating, wave_count, notes, created_at, updated_at)
//             values (?, ?, ?, ?, ?, ?, datetime('now'), datetime('now'))";
//     DB::insert($sql, array($userId, $spotId, $date, $rating, $waveCount, $notes));
//     return DB::getPdo()->lastInsertId();
// }

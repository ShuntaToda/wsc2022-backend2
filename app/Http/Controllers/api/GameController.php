<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->merge([
            "page" => $request->input("page", 0),
            "size" => $request->input("size", 10),
            "sortBy" => $request->input("sortBy", "title"),
            "sortDir" => $request->input("sortDir", "asc"),
        ]);

        $request->validate([
            "page" => ["required"],
            "size" => ["required", "min:1"],
            "sortBy" => ["required", "in:title,popular,uploaddate"],
            "sortDir" => ["required", "in:asc,desc"],
        ]);

        $sortBy = "title";
        if ($sortBy === "uploaddate") $sortBy = "updated_at";

        $games = Game::orderBy($sortBy, $request->sortDir)->get();

        $sortedGames = $games;
        if ($request->sortBy === "popular") {
            if ($request->sortDir === "desc") {
                $sortedGames = $games->sort(function ($a, $b) {
                    return $a->score_count - $b->score_count;
                })->values();
            } else {
                $sortedGames = $games->sort(function ($a, $b) {
                    return $a->score_count - $b->score_count;
                })->reverse()->values();
            }
        }

        $pagedData = $sortedGames->paginate($request->page, ["*"], "");
        return $games;



        $sortedGames = $games->sortByDesc(function ($game) {
            return $game->game_versions->sum("game_id");
        });
        return $sortedGames;
        // orderBy($sortBy, $request->sortDir)->get();

        return $games;
        // {
        // "page": 0,
        // "size": 10,
        // "totalElements": 15,
        // "content": [
        // {
        // "slug": "demo-game-1",
        // "title": "Demo Game 1",
        // "description": "This is demo game 1",
        // "thumbnail": "/games/:slug/:version/thumbnail.png",
        // "uploadTimestamp": "2032-01-31T21:59:35.000Z",
        // "author": "dev1",
        // "scoreCount": 5
        // }
        // ]
        // }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

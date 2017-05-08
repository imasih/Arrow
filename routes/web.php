<?php
Route::post("/bot", "Bot@hook");
Route::get("/db", "Bot@db");
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return $rooms;
    }

    public function show($id)
    {
        $room = Room::find($id);

        return $room;
    }

    public function create (Request $request)
    {
        $room = Room::create([
            'name'=> $request->name
        ]);

        return $room;
    }

    public function update($id, Request $request)
    {
        $room = Room::find($id);

        $room->update([
            'name'=> $request->name
        ]);
        
        return $room;
    }


    public function delete($room_id)
    {
        $room = Room::find($room_id);

        return $room->delete();
    }  
}

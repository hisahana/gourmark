<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index() {
        $bookmarks = Bookmark::all();
        return $bookmarks;
    }

    public function store(Request $request) {
        $bookmark = new Bookmark;
        $bookmark->category_id = $request->categoryId;
        $bookmark->name = $request->name;
        $bookmark->memo = $request->memo;
        $bookmark->image_path = null;
        $bookmark->lat = $request->lat;
        $bookmark->lng = $request->lng;
        $bookmark->user_id = 1;
    }

    public function update(Request $request, $id) {
        $bookmark = Bookmark::find($id);
        $bookmark->category_id = $request->categoryId;
        $bookmark->name = $request->name;
        $bookmark->memo = $request->memo;
        $bookmark->image_path = null;
        $bookmark->lat = $request->lat;
        $bookmark->lng = $request->lng;
        $bookmark->save();
    }

    public function destroy($id) {
        $bookmark = Bookmark::find($id);
        $bookmark->delete();
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function index(Request $request) {
        // 拡大率を元に取得範囲を設定
        $zoom = $request->zoom ? $request->zoom : 12;
        $distance = 5;

        $bookmarks = Bookmark::with('category')->orderBy('id', 'desc')->get();
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
        $bookmark->save();
        return $bookmark;
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
        return $bookmark;
    }

    public function destroy($id) {
        $bookmark = Bookmark::find($id);
        $bookmark->delete();
    }
}

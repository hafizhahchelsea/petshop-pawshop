<?php
namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;

        $reviews = Review::when($status, function($query) use ($status){
            return $query->where('status', $status);
        })->latest()->get();

        return view('admin.reviews', compact('reviews', 'status'));
    }

    public function updateStatus(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $review->status = $request->status;
        $review->save();

        return back()->with('success', 'Status ulasan diperbarui');
    }

    public function delete($id)
    {
        Review::findOrFail($id)->delete();
        return back()->with('success', 'Ulasan berhasil dihapus');
    }
}

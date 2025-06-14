<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductRatingController extends Controller
{
    /**
     * Store a new product rating
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'rating_description' => 'required|string|max:1000',
            'product_id' => 'sometimes|exists:products,id' // Optional safety check
        ]);

        // Check if user already reviewed this product
        $existingReview = $product->ratings()
                                ->where('user_id', Auth::id())
                                ->first();

        if ($existingReview) {
            return back()
                ->withInput()
                ->withErrors(['rating' => 'You have already reviewed this product.']);
        }

        $rating = $product->ratings()->create([
            'user_id' => Auth::id(),
            'rating' => $validated['rating'],
            'rating_description' => $validated['rating_description']
        ]);

        return back()
            ->with('success', 'Thank you for your review!')
            ->with('scroll_to', 'reviews-section'); // For auto-scrolling to reviews
    }

    /**
     * Get product rating summary
     */
    public function getRatingSummary(Product $product)
    {
        $summary = [
            'average' => $product->ratings()->avg('rating') ?? 0,
            'count' => $product->ratings()->count(),
            'distribution' => []
        ];

        // Get rating distribution (1-5 stars)
        for ($i = 1; $i <= 5; $i++) {
            $summary['distribution'][$i] = $product->ratings()
                ->where('rating', $i)
                ->count();
        }

        return response()->json($summary);
    }

    /**
     * Get paginated reviews
     */
    public function getReviews(Product $product)
    {
        $reviews = $product->ratings()
            ->with('user:id,name') // Only get necessary user data
            ->latest()
            ->paginate(5);

        return response()->json($reviews);
    }
}
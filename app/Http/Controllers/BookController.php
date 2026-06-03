<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($category = $request->get('category')) {
            $query->where('category', $category);
        }

        $sort = $request->get('sort', 'default');
        match ($sort) {
            'price_asc' => $query->orderBy('price'),
            'price_desc' => $query->orderByDesc('price'),
            'rating' => $query->orderByDesc('rating'),
            'popular' => $query->orderByDesc('sold'),
            default => $query->orderBy('id'),
        };

        $books = $query->with('seller')->paginate(12);
        $categories = Category::all();

        return view('dashboard.buyer.search', compact('books', 'categories'));
    }

    public function showBookToBuyer()
    {
        $books = Book::all();
        $categories = Category::all();
        
        return view('dashboard.buyer.home', compact('books', 'categories'));
    }

    public function showBookToSeller()
    {
        $user = Auth::user();
        $books = Book::where('seller_id', $user->id)->orderByDesc('id')->paginate(12);
        $categories = Category::all();

        return view('dashboard.seller.catalog', compact('books', 'categories'));
    }

    public function searchSellerBook(Request $request)
    {
        $user = Auth::user();
        $query = Book::where('seller_id', $user->id);

        if ($request->filled('search-inventory')) {
            $search = $request->get('search-inventory');
            
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->get('category'));
        }

        if ($request->filled('filter-status')) {
            $status = $request->get('filter-status');
            if ($status === 'in_stock') {
                $query->where('stock', '>', 5);
            } elseif ($status === 'low_stock') {
                $query->whereBetween('stock', [1, 5]);
            } elseif ($status === 'out_of_stock') {
                $query->where('stock', '=', 0);
            }
        }

        $books = $query->with('seller')->orderByDesc('id')->paginate(12)->withQueryString();

        $categories = Book::where('seller_id', $user->id)
                        ->whereNotNull('category')
                        ->where('category', '!=', '')
                        ->distinct()
                        ->pluck('category'); 

        return view('dashboard.seller.catalog', compact('books', 'categories'));
    }
    public function showBookById($id)
    {
        $book = Book::with('seller')->findOrFail($id);

        return view('dashboard.buyer.detail', compact('book'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('books.createbook', compact('categories'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'category'    => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'year'        => 'required|integer|min:1000|max:2100',
            'publisher'   => 'nullable|string|max:255',
            'language'    => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        
        $finalColor = $request->filled('cover_color_custom') 
                    ? $request->input('cover_color_custom') 
                    : $request->input('cover_color', '#5f3822');

        Book::create([
            'seller_id'   => Auth::id(),
            'title'       => $validated['title'],
            'author'      => $validated['author'],
            'category'    => $validated['category'],
            'publisher'   => $validated['publisher'],
            'year'        => $validated['year'],
            'language'    => $validated['language'],
            'description' => $validated['description'],
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'cover_color' => $finalColor, 
            
            'rating'      => 0,
            'sold'        => 0,
            'is_new'      => true,
            'pages'       => 0,
        ]);

        return redirect()->route('seller.catalog')->with('success', 'Buku berhasil ditambahkan!');
    }
}

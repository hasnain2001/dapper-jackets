<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Product;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

  
 
    public function blogs() {
        $blogs = Blog::all(); 
        return view('admin.Blog.index', compact('blogs'));
    }
    
    









    public function create() {
        return view('admin.Blog.create');
    }

    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'title' => 'required|string|max:255', 
        'slug' => 'required|string|max:255', 
        'content' => 'required|string',
        'category_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'meta_title' => 'nullable|string|max:65',
        'meta_description' => 'nullable|string|max:155', 
        'meta_keyword' => 'nullable|string|max:255', 
        ]);
    
       
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $imagePath = 'uploads/blog/'.$imageName;
        } else {
            $imagePath = null;
        }

        $blog = new Blog();
        $blog->title = $request->input('title');
        $blog->slug = $request->input('slug');
        $blog->content = $request->input('content');

        $blog->category_image = $imagePath;  

$content = $request->input('content');
$content = preg_replace('/<o:p[^>]*>(.*?)<\/o:p>/', '', $content);
$dom = new \DomDocument();
$dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
$images = $dom->getElementsByTagName("img");
foreach ($images as $img) {
    $image_64 = $img->getAttribute('src');
    $image_parts = explode(';', $image_64);

    if (count($image_parts) > 0) {
        $image_data = explode(',', $image_parts[1]);

        if (count($image_data) > 1) {
            $extension_parts = explode('.', $image_data[0]);
            if (isset($extension_parts[1])) {
                $extension = explode('/', $extension_parts[1])[1];
                $replace = $image_data[0] . ';';
                $image = str_replace($replace, '', $image_data[1]);
                $image = str_replace(' ', '+', $image);
                $imageName = Str::random(10) . '.' . $extension;

                $image_name = "/upload/" . $imageName;
                $path = public_path() . $imageName;

                file_put_contents($path, base64_decode($image));

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }
    }
}

$blog->content = $dom->saveHTML();
$blog->save();

        session()->flash('<div class="alert alert-info" role="alert">
        blog created succesfully
        </div>');
    
 
        return redirect()->back()->with('success', 'Blog created successfully.');
    }


    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.Blog.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required|string',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif',
            
            'meta_title' => 'nullable|string|max:65',
            'meta_description' => 'nullable|string|max:155',
            'meta_keyword' => 'nullable|string|max:255',
        ]);
    

        $blog = Blog::findOrFail($id);
    
        
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $imagePath = 'uploads/blog/' . $imageName;
            $blog->category_image = $imagePath;
        }
        $content = $request->input('content');
        $content = preg_replace('/<o:p[^>]*>(.*?)<\/o:p>/', '', $content);
        $dom = new \DomDocument();
        libxml_use_internal_errors(true);
    
        $dom->loadHTML($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    
        $errors = libxml_get_errors();
        if (!empty($errors)) {
        }
    
        libxml_clear_errors();
        $blog->content = $dom->saveHTML();
        $blog->title = $validatedData['title'];
        $blog->slug = $validatedData['slug'];
        $blog->meta_title = $request->input('meta_title');
        $blog->meta_description = $request->input('meta_description');
        $blog->meta_keyword = $request->input('meta_keyword');
    
      
        $blog->save();
    
        
        return redirect()->back()->with('success', 'Blog updated successfully.');
    }
    

public function destroy($id)
{
   $blog = Blog::findOrFail($id);
    $blog->delete();
    return redirect()->back()->with('success', 'Blog deleted successfully.');
}

    public function index()
    {
        $blogs = Blog::paginate(10); 
        return view('admin.Blog', compact('blogs'));
    }
       public function deleteSelected(Request $request)
    {
        $selectedIds = $request->input('selected_blogs');

        if ($selectedIds) {
          
            Blog::whereIn('id', $selectedIds)->delete();

            return redirect()->back()->with('success', 'Selected blog entries deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'No blog entries selected for deletion.');
        }
    }
    
public function bulkDelete(Request $request)
    {
        $selectedBlogs = $request->input('selected_blogs');

        if ($selectedBlogs) {
            Blog::whereIn('id', $selectedBlogs)->delete();
            return redirect()->back()->with('success', 'Selected blog entries deleted successfully.');
        }

       return redirect()->back()->with('error', 'No blog entries selected for deletion.');
    }


}

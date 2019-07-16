<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Essay;
use App\Book;
use App\Subscription;


use Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EssaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $essays = Essay::orderBy('created_at','desc')->paginate(10);
        return view('essays.index')->with('essays', $essays);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $books = Book::all();
        $subscriptions = Subscription::all();

        return view('essays.create')->with('books', $books)->with('subscriptions', $subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'essay_title' => 'required',
            'essay_body' => 'required',
            'file_name'=>'mimes:pdf|nullable|max:1999',
            'cover_image' => 'image|nullable|max:1999'
        ]);
            $filenameWithExt1 = $request->file('file_name')->getClientOriginalName();
            // Get just filename
            $filename1 = pathinfo($filenameWithExt1, PATHINFO_FILENAME);
            // Get just ext
            $extension1= $request->file('file_name')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore1= $filename1.'_'.time().'.'.$extension1;
            // Upload Image
            $path1 = $request->file('file_name')->storeAs('public/cover_images', $fileNameToStore1);
            // Handle File Upload

        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Essay
        $essay = new Essay;
        $essay->essay_title = $request->input('essay_title');
        $essay->essay_body = $request->input('essay_body');
        $essay->file_name = $fileNameToStore1;
        $essay->essay_date = $request->input('essay_date');

        // $essay->user_id = auth()->user()->essay_id;
        $essay->user_id =1;
        $essay->is_active = 1;

        $essay->cover_image = $fileNameToStore;
        $books = Book::all();
        $essay->subscription_id = $request->get('subscription_selector');

        $essay->save();
        foreach($books as $book){
            if($request->input($book->book_title)=='on'){
                $essay->books()->attach($book->book_id);
            }
        }
        return redirect('/essays')->with('success', 'Essay Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $essay_id
     * @return \Illuminate\Http\Response
     */
    public function show($essay_id)
    {
        $essay = Essay::find($essay_id);
        $books = $essay->books;

        // dd($books);
        return view('essays.show')->with('essay', $essay)->with('books',$books);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $essay_id
     * @return \Illuminate\Http\Response
     */
    public function edit($essay_id)
    {
        $essay = Essay::find($essay_id);
        $books = Book::all();
        $subscriptions = Subscription::all();

        // Check for correct user
        // if(auth()->user()->essay_id !==$essay->user_id){
        //     return redirect('/essays')->with('error', 'Unauthorized Page');
        // }

        return view('essays.edit')->with('books', $books)->with('essay', $essay)->with('subscriptions', $subscriptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $essay_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $essay_id)
    {
        $this->validate($request, [
            'essay_title' => 'required',
            'essay_body' => 'required'
        ]);

         // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        }

        // Create Essay
        $essay = Essay::find($essay_id);
        $essay->essay_title = $request->input('essay_title');
        $essay->essay_body = $request->input('essay_body');
        // dd($request->input('essay_date'));
        $essay->essay_date = $request->input('essay_date');
        
        if($request->hasFile('cover_image')){
            $essay->cover_image = $fileNameToStore;
        }
        $essay->subscription_id = $request->get('subscription_selector');
        $essay->save();
        $books = Book::all();

        foreach($books as $book){
            $essay->books()->detach($book->book_id);

            if($request->input($book->book_title)=='on'){
                $essay->books()->attach($book->book_id);
            }
        }
        return redirect('/essays')->with('success', 'Essay Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $essay_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($essay_id)
    {
        $essay = Essay::find($essay_id);

        // Check for correct user
        // if(auth()->user()->essay_id !==$essay->user_id){
        //     return redirect('/essays')->with('error', 'Unauthorized Page');
        // }

        if($essay->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$essay->cover_image);
        }
        Storage::delete('public/cover_images/'.$essay->file_name);

        $essay->delete();
        return redirect('/essays')->with('success', 'Essay Removed');
    }
    public function toggle(Request $request)
    {
        // Log::info($request->essay_id);
        $essay = Essay::find($request->essay_id);
        $essay->is_active=($essay->is_active=='1')?'0':'1';
        $essay->save();
            // $grocery = new Grocery();
            // $grocery->name = $request->name;
            // $grocery->type = $request->type;
            // $grocery->price = $request->price;

            // $grocery->save();
            
        return response()->json(['success'=>'Data is successfully added']);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $home = Home::first();

        return view('backend.home.index',[
            'title' => 'Home',
            'home' => $home
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'content' => 'required',
        ]);      

        Home::updateOrCreate([], [
            'body' => $request->content
        ]);

        return redirect()->route('backend.home.index')->with('success', 'Home updated successfully');
    }

    public function updateImage(Request $request): RedirectResponse
    {
        $request->validate([
            'url' => 'nullable|url',
            'imageInput' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);          

        $home = Home::first();
        $data = [];

        $radioValue = $request->input('radioType');

        switch ($radioValue) {
            case 'image':
                if (!empty($home->image)) {
                    Home::updateOrCreate([], [
                        'image' => $home->image,
                        'url' => null,
                    ]);
                } else {
                    if ($request->hasFile('imageInput')) {
                        $file = $request->file('imageInput');
                        
                        $fileName = time() . '.' . $file->getClientOriginalExtension();
    
                        $directory = 'uploads/home';
                        
                        $file->move(public_path($directory), $fileName);
    
                        if (!empty($home->image)) {
                            File::delete(public_path($home->image));
                        }
    
                        $data['image_path'] = $directory . '/' . $fileName;
                    }
    
                    Home::updateOrCreate([], [
                        'image' => $data['image_path'],
                        'url' => null,
                    ]);
                }

                break;

            case 'url':
                if (!empty($home->image)) {
                    File::delete(public_path($home->image));
                }

                $data['url'] = $request->input('urlLink');

                Home::updateOrCreate([], [
                    'image' => null,
                    'url' => $data['url'],
                ]);
                
                break;

            case 'removeImage':
                if (!empty($home->image)) {
                    File::delete(public_path($home->image));
                }
    
                Home::updateOrCreate([], [
                    'image' => null,
                    'url' => null,
                ]);
                    
                break;

            default:
                break;
        }

        return redirect()->route('backend.home.index')->with('success', 'Home updated successfully');
    }
}

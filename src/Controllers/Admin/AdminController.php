<?php

namespace Azuriom\Plugin\Uploader\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Uploader\Models\Files;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the home admin page of the plugin.
     *
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $files = Files::all();
        return view('uploader::admin.index', compact('files'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:1|max:255',
            'file' => 'required|mimes:exe,jar,rar,zip,7z|unique:files,title'
        ]);

        if ($request->hasFile('file')){
            $file = $request->file('file')->storeAs('files', \Str::slug($request->title) . '.' . $request->file->extension(), 'public');
            Files::create([
                'title' => $request->title,
                'link' => $file
            ]);
        }

        return redirect()->back()->with('status', trans('uploader::admin.success'));
    }

    public function destroy($id, Files $files){
        $path = $files->where('id',$id)->value('link');
        Storage::disk('public')->delete($path);
        Files::where('id',$id)->delete();
        return redirect()->back()->with('success', trans('uploader::admin.deleted'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Product;


use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function redirect()
    {
        $typeuser = Auth::user()->typeuser;

        if($typeuser=='1')
        {
            return view('admin.home');
        }

        else
        {
            $data = product::paginate(1);

            return view('user.home', compact('data'));
        }

    }

    public function index()
    {
        if(Auth::id())
        {
            return redirect('redirect');
        }
        else
        {

            $data = product::paginate(1);

            return view('user.home', compact('data'));

        }
        
    }

    public function search(Request $request){

        $search = $request->search;

        if ($search =="")
        {
            $data = product::paginate(3);
            return view('user.home', compact('data'));
        }

        $data = product::where('title', 'Like', '%' . $search . '%')->get();

        return view('user.home', compact('data'));
    }
}


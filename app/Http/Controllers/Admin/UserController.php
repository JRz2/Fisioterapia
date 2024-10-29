<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Consulta;
use App\Models\Sesion;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.user.index')->only('index');
        $this->middleware('can:admin.user.create')->only('create','store');
        $this->middleware('can:admin.user.edit')->only('edit','update');
        $this->middleware('can:admin.user.destroy')->only('destroy');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return view('admin.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([    
            'name'=>'required|unique:users',
            'email'=>'required|unique:users',
        ]);
        $user = User::create($request->only('name','email') 
        + [
        'password' => bcrypt($request->input('password')),
    ]);

    //$roles = $request->input('roles',[]);
    $user->roles()->sync($request->roles);
    //$user->syncRoles($roles); 
    return redirect()->route('admin.user.index')->with('guardar','ok');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.user.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles= Role::all();
        return view('admin.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update ($request->all());
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.user.index')->with('editar', 'ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('eliminar', 'ok');
    }
/*
    public function pdf()
    {
        $user=User::all();
        $pdf = Pdf::loadView('admin.user.pdf', compact('user'));
        return $pdf->stream();  
       //return view('admin.user.index',compact('user'));
        //return $pdf->download('invoice.pdf');
        //return view('admin.user.pdf',compact('user'));
    }
*/
}
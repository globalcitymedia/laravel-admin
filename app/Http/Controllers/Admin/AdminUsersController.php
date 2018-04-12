<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{

    protected $object_name = 'admin_users';

    public function index(){
        $page_title = "Admin Users";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $users = User::adminUsers()->paginate(config('variables.paginate_count'));

        $breadcrums = array(['title'=>$page_title, 'url'=>'']);
        //dd($users);
        return view('admin.admin_users.index', compact('users','page_title','object_name','breadcrums'));
    }

    public function create(){
        $page_title = "Create admin user";
        $object_name = $this->object_name;
        $breadcrums = array(['title'=>'Admin Users', 'url'=>'/admin/admin_users'],['title'=>'Edit Author', 'url'=>'']);
        return view('admin.admin_users.create', compact('page_title','object_name','breadcrums'));
    }

    //if validation fails
    //Request $request ==> method injection
    public function store(UserRequest $request) {
        //dd($request);
        $request['password'] = bcrypt($request['password']);
        $request['role'] = 'admin';
        $request['created_by'] = Auth::user()->id;
        $request['updated_by'] = Auth::user()->id;
        //dd($request);
        $user = new User($request->all());

        //dd($user);
        $user->saveOrFail($user->toArray());

        return redirect('/admin/admin_users');

    }


    public function edit($id){
        $page_title = "Edit admin user";
        $object_name = $this->object_name;
        //$articles = Article::orderby('created_at','desc')->get();
        $user = User::FindOrFail($id);
        $breadcrums = array(['title'=>'Admin Users', 'url'=>'/admin/admin_users'],['title'=>'Edit Author', 'url'=>'']);
        //dd($users);
        return view('admin.admin_users.edit', compact('user','page_title','object_name','breadcrums'));

    }


    //if validation fails
    //Request $request ==> method injection
    public function update($id, UserRequest $request)  {

        $user = User::findOrFail($id);

        if($request['password'] != ''):
            //dd($request['password']);
            $request['password'] = bcrypt($request['password']);
        else:
            unset($request['password']);
        endif;
        $request['updated_by'] = Auth::user()->id;
        $user->update($request->all());

        return redirect('/admin/admin_users');

    }


    public function destroy($id)
    {
        $user = User::findORFail($id);

        $user->delete();

        return redirect('/admin/admin_users');

    }


}

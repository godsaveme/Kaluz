<?php

namespace Salesfly\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Salesfly\User;
use Salesfly\Salesfly\Entities\Store;
use Validator;
use Salesfly\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    /**
     * @var $redirectPath
     * @desc Variable para ser redirigida cuando inicie sesión
     */
    protected $redirectPath = 'paramselect';


    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',
            ['except' => [
                'getLogout',
                'indexU',
                'all',
                'paginate',
                'form_create',
                'form_edit',
                'store_select',
                'postRegister',
                'search',
                'find',
                'edit',
                'disableuser',
                'changePass',
                'destroy'
            ]]);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'store_id' => 'required|integer',
            'role_id' => 'required|integer',
            'estado' => 'required|integer',
            'image' => ''
        ]);
    }

    /**
     * Get a validator for an incoming edit request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorEdit(array $data)
    {
        $user = User::find($data['id']);
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'store_id' => 'required|integer',
            'role_id' => 'required|integer',
            'estado' => 'required|integer',
            'image' => ''
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'store_id' => $data['store_id'],
            'role_id' => $data['role_id'],
            'estado' => $data['estado']
        ]);
    }

    /**
     * Update a user instance after edit form.
     *
     * @param  array  $data
     * @return User
     */
    protected function update(User $user,array $data)
    {
        //retorna filas afectadas;
         $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'store_id' => $data['store_id'],
            'role_id' => $data['role_id'],
            'estado' => $data['estado']
        ]);
        return $user;
    }


    /**
    * funciones creadas por Salesfly
     **/
    protected  function indexU()
    {
        if(\Auth::check()){
            return View('auth.users.index');
        }else{
            return redirect()->to('auth/login');
        }

    }

    protected  function all()
    {
        if(\Auth::check()){
            $users = User::all();
            return response()->json($users);
        }else{
            return redirect()->to('auth/login');
        }
    }

    protected  function paginate(){
        if(\Auth::check()) {
            $users = User::with(array('store'=>function($query){
                $query->select('id','nombreTienda');
            }))->paginate(15);
            return response()->json($users);

        }else{
            return redirect()->to('auth/login');
        }
    }
    public function form_create()
    {
        return View('auth.users.form_create');
    }

    public function form_edit()
    {
        return View('auth.users.form_edit');
    }
    public function store_select()
    {
        $stores = Store::lists('nombreTienda','id');
        return response()->json($stores);
    }
    public function search($q){
        $users =User::where('name','like', $q.'%')
            ->orWhere('email','like',$q.'%')
            ->paginate(15);
        return $users;
    }
    public function find($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function disableuser($userId){
        \DB::beginTransaction();
        $user = User::find($userId);
        $estado = $user->estado;

            if ($estado == 1) {
                $user->estado = 0;
            } else {
                $user->estado = 1;
            }

        $user->save();

        \DB::commit();
        return response()->json(['estado'=>true]);
    }

    public function destroy(Request $request)
    {
        $user= User::find($request->id);
        $user->delete();
        return response()->json(['estado'=>true]);
    }


}

<?php
class UsuarioController extends BaseController
{
	//siempre action_
	//$restful get y post
	protected $layout = 'layouts.layout';

    /**
     * Show the profile for the given user.
     */

    public function getLogin(){
        if (Auth::check()){
            return Redirect::to('admin/home');
        }else{
            return View::make('login')->with('success', true);;
        }
    }

    public function postLogin(){
        $credentials = array(
        'email' => Input::get('email'),
        'password' => Input::get('password'));
        if(Auth::attempt($credentials)){
            $user = Usuario::where('email', '=', Input::get('email'))->firstOrFail();
            Auth::login($user);
            return Redirect::to('admin/home');
        }else{
            return View::make('login')->with('success', false);
        }
    }


    public function Home(){
            $recaudaciones = Recaudacion::selectRaw('id, sum(efectivo_real) as efectivo, fecha')
                        ->where(DB::raw('MONTH(fecha)'), date('n'))->get();
                return View::make('home' , compact('recaudaciones'));
    }

    public function CrearRoles(){

        /*$admin = new Role();
        $admin->name         = 'administracion';
        $admin->save();

        $secretaria = new Role();
        $secretaria->name         = 'recepcion';
        $secretaria->save();

        $secretaria = new Role();
        $secretaria->name         = 'jefe_local';
        $secretaria->save();

        $secretaria = new Role();
        $secretaria->name         = 'empleado';
        $secretaria->save();*/
    }



    public function LoginUsuarioGet(){
        $credentials = array(
        'email' => Input::get('email'),
        'password' => Input::get('password'));
        if(Auth::attempt($credentials)){
            $user = Usuario::where('email', '=', Input::get('email'))->firstOrFail();
            Auth::login($user);
            return View::make('home');
        }else{
            return Response::json(array('msg'=>'0'));
        }
    }

     public function CerrarSesionGet(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function CrudUsuarios(){

        $permiso = array(
            '0'=>'Seleccione un permiso',
            'Administrador'=>'Administrador',
            'Alumno'=>'Alumno',
            'Profesor'=>'Profesor'
            );
        $activo = array(1 => 'Si', 0 => 'No');

        $edit = DataEdit::source(new Usuario());
        $edit->label('Usuarios');
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('apellido_paterno','Apellido Paterno', 'text')->rule('required');
        $edit->add('apellido_materno','Apellido Materno', 'text')->rule('required');
        $edit->add('fecha_nacimiento','Fecha Nacimiento','date')->format('d/m/Y', 'it');
        $edit->add('rut','Rut', 'text')->rule('required');
        $edit->add('telefono','Telefono', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');
        $edit->add('id_plan','Plan','select')->options(Planes::lists("nombre", "id"));
        $edit->add('imagen','Foto', 'image')->move('uploads/usuarios/')->fit(240, 160)->preview(120,80);
        $edit->add('activo','Activo','select')->options($activo);
        $edit->add('password','Passwrod', 'password')->rule('required');

        return $edit->view('usuarios.crudusuarios', compact('edit'));
    }

    public function AsignarRolGet($id = null){
        if($id){
            $usuario = Usuario::find($id);
        if(isset($usuario)){
            $user_role = DB::table('assigned_roles')
                    ->where('user_id', $id)
                    ->lists('role_id');
            $roles = DB::table('roles')->get();
            if(Entrust::hasRole('recepcion')){
                $roles = DB::table('roles')->where('name','instructores')
                                            ->orWhere('name','alumno')->get();
            }
            return View::make('usuarios.asignarol')->with('usuario', $usuario)
                                            ->with('roles', $roles)
                                            ->with('user_role', $user_role);
        }else{
            return Redirect::to('/');
        }
        }else{
            return Redirect::to('/');
        }
    }

    /**
     * Asigna Rol Post
     *
     * @return Response
     */
    public function AsignarRolPost(){
        $id = Input::get('user_id');
        $role_user = Input::get('role_user');
        $user = Usuario::find($id);

        $rol_user = DB::table('assigned_roles')
                    ->where('user_id', $id)
                    ->delete();

        if($role_user){
            foreach ($role_user as $ru) {
                DB::table('assigned_roles')->insert(
                    array('user_id' => $id, 'role_id' => $ru)
                );
            }
        }


        return Redirect::to('/');
    }

    public function ObtieneUserLogeado(){
        if(Auth::check()){
            $user = Usuario::find(Auth::user()->id);
            $nombre = $user->usuario;
            $email = $user->email;
            $esCreado = $user->esCreado;
            $id = $user->id;
            return Response::json(array('msg'=>'true','nombre'=>$nombre,'email'=>$email, 'esCreado'=>$esCreado));
        }else{
            return Response::json(array('msg'=>'false'));
        }
    }

    //cambia la imagen del perfil
    public function CargaImagenPerfil(){
        if (Input::hasFile('file')){
            $perfil = DB::table('perfiles')
                    ->where('usuario_id', Auth::user()->id)
                    ->first();
            $file = Input::file('file');
            $destinationPath = '../public/perfil';
            $extension =$file->getClientOriginalExtension();
            $file_name = $file->getClientOriginalName();
            $filename = $file_name.'.'.$extension;
            $perfil->avatar_path = $filename;
            $perfil->save();
            $upload_success = $file->move($destinationPath, $filename);
        }
        return Response::json(array('msg'=>'ok'));
    }



    public function getUsuarioList(){
        return Usuario::where("nombre","like", Input::get("q")."%")
                ->orWhere("email","like", Input::get("q")."%")
                ->orWhere("apellido_paterno","like", Input::get("q")."%")
                ->orWhere("apellido_materno","like", Input::get("q")."%")->take(10)->get();
    }
}
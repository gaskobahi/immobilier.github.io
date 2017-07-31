<?php

namespace App\Http\Controllers\Auth;

use App\Annonce;
use App\Http\Requests\UserCreateRequest;
use App\Role;
use App\User;
use App\Http\Controllers\Controller;
use function foo\func;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserUpdateRequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/utilisateurs';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function admin()
    {
        $users = User::all();
        $annonces = Annonce::all();
        $totalannonces=count($annonces);
        $totalusers=count($users);
        $pourcentageOfBoysOnAllUser=$this->pourcentageOfBoysOnAllUser($users);
        $pourcentageOfGirlsOnAllUser=$this->pourcentageOfGirlsOnAllUser($users);
        $totalOfGirlsOnAllUser=$this->TotalOfGirlsOnAllUser($users);
        $totalOfBoysOnAllUser=$this->TotalOfBoysOnAllUser($users);
            return view('backend',compact('totalusers','pourcentageOfBoysOnAllUser',
                'pourcentageOfGirlsOnAllUser','totalOfGirlsOnAllUser','totalOfBoysOnAllUser',
                'totalannonces'));
    }



    public function showRegistrationForm()
    {
        $roles = Role::all();
        //dd($roles);
        return view('auth.register',compact('roles'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  /*  protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'pseudo' => 'required|string|max:255',
            'sexe' => 'required|string|max:255',
            'role' => 'required',
            'photo' => 'required|image',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }*/


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function register(UserCreateRequest $data)
    {
        $filename='';
        $destinationPath='uploads/users/';
        $isactif=0;
        if(isset($data['isactif'])){
            $isactif=$data['isactif'];
        }
        if($data->hasFile('photo')){
            $image = $data->file('photo');
            $filename=$data['pseudo'].'.'.$image->getClientOriginalExtension();
            if(file_exists(public_path($destinationPath.$filename))){
                unlink(public_path($destinationPath.$filename));
            }
            Image::make($image)->resize(70,70)->save(public_path($destinationPath.$filename));
        }
       // dd($filename);
        User::create([
            'name' => strtoupper($data['name']),
            'surname' => ucwords($data['surname']),
            'pseudo' => strtoupper($data['pseudo']),
            'sexe' => $data['sexe'],
            'role_id' => $data['role_id'],
            //'isactif' => $data['isactif'],
            'isactif' => $isactif,
            'email' => $data['email'],
            'photo' => $filename,
            'password' => bcrypt($data['password']),
        ]);

        return  redirect(route('users.show'));
    }

    ////////////////////////////////////////////////////
    public function showUsers()
    {
        //$user=Auth::user();
        $users = User::paginate(6);
        $link=$users->links();
        return view('auth.usersshow',compact('users','link'));
    }

    public function edit($id){
        $roles = Role::all();
        $user = DB::table('users')->where('id',$id)->first();
        return view('auth.edit',compact('user','roles'));
    }


    public function update(UserUpdateRequest $request,$id){
        $filename='';
        $destinationPath='uploads/users/';
        $user = User::findOrFail($id);
       // dd($user->photo);
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $filename=$request['pseudo'].'.'.$image->getClientOriginalExtension();
            if(file_exists(public_path($destinationPath.$filename))){
                unlink(public_path($destinationPath.$filename));
            }
            Image::make($image)->resize(70,70)->save(public_path($destinationPath.$filename));
        }else{
            $filename=$user->photo;
        }

        $user->name=strtoupper($request->get('name'));
        $user->surname=ucwords($request->get('surname'));
        $user->pseudo=strtoupper($request->get('pseudo'));
        $user->role_id=$request->get('role_id');
        $user->isactif=$request->get('isactif');
        $user->sexe=$request->get('sexe');
        $user->email=$request->get('email');
        $user->isactif=$request->get('isactif');
        $user->photo=$filename;
        // $user->password=$request->get('password');
        $user->update();
        return redirect(route('users.show'));

    }


    public function profile($id){
        //$user = DB::table('users')->where('id',$id)->first();
        $user = User::findOrFail($id);
        return view('auth.profile',compact('user'));
    }

    public function updatepassword($id){
        $lastpasswd =$this->getPassword($id);
        // {{dd($id);}}
        return view('auth.passwordchange',compact('lastpasswd','id'));
    }
    public function updatepasswordpost(UserChangePasswordRequest $request){
        //$userpass = User::findOrFail($id);
        if (Hash::check($request->lastpassword, $request->lastpasswd)) {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
            return redirect(Route('user.profile',$request->user()->id))->withOk("Modification du mot passe reussie");
        }
        return redirect(Route('user.updatepassword',$request->user()->id))->withError("L'Ancien mot de passe n'est pas correcte");

    }
    public function userdelete($id){
        $user = User::findOrFail($id);
            return view('auth.confirmuserdelete',compact('user'));
        }


    public function confirmuserdelete($id){
        $user = User::findOrFail($id);
        if($user->getUserRole()->name=='superadmin'){
            return redirect(route('users.show',compact('user')))->with('statusshowuser',' Impossible de supprimer le super administrateur ' .$user->pseudo);
        }

        if($user->checkIfUserHasAnnonce()===true){
            return redirect(route('users.show',compact('user')))->with('statusshowuser','Suppression impossible car ' .$user->pseudo. ' possède au mois une annonnce');
        }
        $user->delete();
        return redirect(route('users.show',compact('user')))->with('statusshowuser', $user->pseudo.' a bien été supprimé');
    }



    private function  getPassword($id){
        $lastpassword = DB::table('users')->where('id', $id)->value('password');
        return $lastpassword;
    }


    private function pourcentageOfBoysOnAllUser($users){
        $val=0;
        $totalusers=count((object)$users);
        for ($i=0;$i<$totalusers;$i++){
            if($users[$i]->sexe=='m'){
                $val=$val+1;
            }
        }
        return  $this->pourcentage($totalusers,$val);
    }
    private function pourcentageOfGirlsOnAllUser($users){
        $prctgirl=100-$this->pourcentageOfBoysOnAllUser($users);
        return  $prctgirl;
    }

    private function TotalOfBoysOnAllUser($users){
        $val=0;
        $totalusers=count((object)$users);
        for ($i=0;$i<$totalusers;$i++){
            if($users[$i]->sexe=='m'){
                $val=$val+1;
            }
        }
        return $val;
    }

    private function TotalOfGirlsOnAllUser($users){
        $val=0;
        $totalusers=count((object)$users);
        for ($i=0;$i<$totalusers;$i++){
            if($users[$i]->sexe=='f'){
                $val=$val+1;
            }
        }
        return $val;
    }



/////////////////////////////////////////////////:calculeur///////////////////////////////////////////////////:


    private function pourcentage($total,$nombre){
        return ceil(($nombre/$total)*100);
    }
}

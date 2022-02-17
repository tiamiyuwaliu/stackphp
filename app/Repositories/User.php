<?php
namespace App\Repositories;

use App\Package\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User   {
    use Repository;

    public $authId;
    public $authUser;
    public $authOwnerId;
    public $authOwner;
    private $isAdmin = false;

    public function __construct()
    {
        if (Auth::check())  {
            $this->authId = Auth::id();
            $this->authUser = Auth::user();
            $this->authOwnerId = $this->authId;
            $this->authOwner = $this->authUser;
            if ($this->authUser->role == 1) $this->isAdmin = true;
        }
    }

    public function isLoggedIn() {
        return Auth::check();
    }
    public function isAdmin() {
        return $this->isAdmin;
    }

    public function getUser($userid = null) {

        if ($userid == $this->authId or !$userid) return $this->authUser;
        //we can make query to find this user
    }

    public function getAvatar($user = null) {
        if (!$user) $user = $this->authUser;
        $avatar  = 'resources/themes/default/images/avatar.png';
        return url($avatar);
    }

    public function addUser($val) {
        $ext = array(
            'name' => '',
            'email' => '',
            'password' => ''
        );
        /**
         * @var $name
         * @var $email
         * @var $password
         */
        extract(array_merge($ext, $val));

        $password = Hash::make($password);
        DB::table('users')->insert(array(
            'name' => $name,
            'email' => $email,
            'password' => $password
        ));
    }

    public function saveUser($val, $id) {
        $ext = array(
            'name' => '',
            'email' => '',
            'password' => '',
            'timezone' => ''
        );
        /**
         * @var $name
         * @var $email
         * @var $password
         * @var $timezone
         */
        extract(array_merge($ext, $val));


        $data = array(
            'name' => $name,
            'email' => $email,
            'timezone' => $timezone
        );
        if ($password) {
            $password = Hash::make($password);
            $data['password'] = $password;
        }
        DB::table('users')->where('id', $id)->update($data);
    }

    public function getUsers($term = null, $termType = 'name', $limit = 20) {
        $query = DB::table('users');
        if ($term) {
            $query->where($termType, 'like', $term);
        }
        $query->orderBy('id', 'desc');
        return $query->paginate($limit);
    }

    public function delete($id) {
        if($id == 1) return false;
        return DB::table('users')->where('id', $id)->delete();
    }

}

<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Auth\AuthController as AUTCTRL;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    private $auth;
    private $user;
    private $utility;

    public function __construct()
    {
        $this->auth = new AUTCTRL();
        $this->utility = new UtilityController();
        $this->user = new UserController();
    }

    public function getLogin()
    {
        $page_title = "Login";
        return view('pages.auth.login.index', compact('page_title'));
    }

    public function resetPassword()
    {
        $page_title = "resetPassword";
        return view('pages.auth.reset.index', compact('page_title'));
    }

    public function facebookActivation(Request $request)
    {
        $code = $request->code;

        $ch = curl_init();
        // Set url elements
        $fb_app_id = '1924855164257064';
        $ak_secret = '11b38740e8f2db3d0ae7cde130f66cdd';
        $token = 'AA|' . $fb_app_id . '|' . $ak_secret;
        // Get access token
        $url = 'https://graph.accountkit.com/v1.0/access_token?grant_type=authorization_code&code=' . $code . '&access_token=' . $token;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        $info = json_decode($result);
        // Get account information
        $url = 'https://graph.accountkit.com/v1.0/me/?access_token=' . $info->access_token;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);

        session()->put('verifiedNumber', json_decode($result)->phone);


        return $result;
    }

    public function handleresetPassword(Request $request)
    {
        $validation = validator($request->all(), [
            'prefix' => 'required',
            'phone' => 'required',
//            'phone' => 'required|digits:10',
        ]);
        if ($validation->fails()) {
            return back()->withInput()->withErrors($validation->getMessageBag()->getMessages());
        }

        $phone = $request->phone;
        $prefix = $request->prefix;

        $user = User::where('phone', $phone)->first();

        if ($user) {
            session()->put('reset_user', $user);
            return redirect()->route('changePassword');
        }

        session()->forget('reset_user');
        return back()->with('error','phone not found');
    }

    public function changePassword(Request $request)
    {
        if (!session()->has('reset_user')){
            return redirect()->route('getLoginView');
        }
        $page_title = "change Password";
        return view('pages.auth.change_password.index', compact('page_title'));
    }

    public function handleChangePassword(Request $request)
    {
        if (!session()->has('reset_user')){
            return redirect()->route('getLoginView');
        }

        $user_id =  session()->get('reset_user')->id;

        $validation = validator($request->all(), [
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validation->fails()) {
            return back()->withInput()->withErrors($validation->getMessageBag()->getMessages());
        }

        if ($user_id){
            if ($user = User::find($user_id)){
                $user->password = bcrypt($request->password);
                $user->save();
            }
        }

        return redirect()->route('getLoginView');
    }

    public function getRegister()
    {
        $page_title = "register";
        $response = $this->utility->getRoles();
        $roles = [];
        if ($response['status']) {
            $roles = $response['data']['roles'];
        }
        // session()->flash('message', __('auth.register_msg')); 
        return view('pages.auth.register.step1', compact('page_title', 'roles'));
    }

    public function handleRegister(Request $request)
    {
        // return $request->all();

        $response = $this->user->registerBasicUserInfo($request);
        if (!$response['status']) {
            return $response;
            // return back()->withErrors($response['data']['validation_errors'])->withInput();
        }
        $user = $response['data']['user'];
        auth()->login($user);
        // session()->flash('message', __('auth.register_msg')); 
        
        // if($request->role_id == 4){
        //     return redirect()->route('getGroupPosts');
        // }
        
        $email = $request->email;
        if($email){ 
            send_email([
            'to'=>$email,
            'content'=>  __('auth.register_msg'),
            'template'=>'mails.activate_mail',
            ]);
        }
        return $response;
        return redirect()->route('getRegisterView2', ['id' => $user->id]);
    }

    public function getRegister2(Request $request, $id)
    {
        $page_title = "register";
        if (auth()->user()->id != $id) {
            return redirect()->route('getLoginView');
        }
        return view('pages.auth.register.step2', compact('page_title'));
    }

    public function handelRegister2(Request $request)
    {
        $user_id = auth()->user()->id;
        $request['user_id'] = $user_id;

        $response = $this->user->registerUserLocation($request);

        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return redirect()->route('getRegisterView3', ['id' => $user_id]);

    }

    public function getRegister3(Request $request, $id)
    {
        $page_title = "register";
        $user = auth()->user();
        if ($user->id != $id) {
            return redirect()->route('getLoginView');
        } 
        return view('pages.auth.register.step3', compact('page_title','user'));
    }

    public function handelRegister3(Request $request)
    {

        $user_id = auth()->user()->id;
        $request['user_id'] = $user_id;

        $response = $this->user->registerUserPapers($request);

        if (!$response['status']) {
            return back()->withErrors($response['data']['validation_errors'])->withInput();
        }

        return redirect()->route('getGroupPosts');
    }

    public function handleLogin(Request $request)
    {
        $response = $this->auth->login($request);

        if ($response['status']) {

            return redirect()->route("getGroupPosts");
        } else {

            return back()->withErrors($response['data']['errors'])->withInput();
        }

    }

    public function handleLogout(Request $request)
    {

        auth()->logout();
        return redirect()->route('getLoginView');

    }
}

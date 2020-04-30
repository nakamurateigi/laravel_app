<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;//クラス内でuseを宣言することでクラス内でもAuthenticatesUsers.php内のtraitメソッドを利用できる
    /*
    ログイン時のバリデーションは以下
    ユーザネーム：必須、文字列
    パスワード：必須、文字列
    */

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //ログイン後の遷移先がtodo一覧画面(/todo)になる
    //デフォルト設定はRedirectsUsersトレイトに記載
    protected $redirectTo = '/todo';

    //ログイン回数制限を5回→3回へ変更
    //デフォルト設定はThrottlesLoginsトレイトに記載
    protected $maxAttempts = 3;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*
        以下処理でLoginControllerアクセス時にguestミドルウェアが適用される
        ログイン状態でミドルウェア処理が実行されると、http://127.0.0.1:8000/homeへ遷移する
        except()は引数に指定したコントローラーメソッドがミドルウェアに適用されなくなる
        except('logout')が無い場合、ログアウトをしようとしてもログアウトができずにhttp://127.0.0.1:8000/homeへ遷移してしまうが
        except('logout')をすれば、logoutメソッドを実行できログアウトすることができる
        */
        $this->middleware('guest')->except('logout');
    }

    //AuthenticatesUsersのtraitのloggedOutメソッドには処理内容が記述されていないため
    //LoginController側でログアウト後の遷移先を記述するようにオーバーライドする
    protected function loggedOut(Request $request)
    {
        return redirect('/login');//ログアウト後の遷移先をログイン画面にする
    }
}

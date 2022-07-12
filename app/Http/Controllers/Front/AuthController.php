<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Password\RestorePasswordRequest;
use App\Http\Requests\Front\Auth\ResetPasswordRequest;
use App\Http\Requests\Front\User\UserCreateRequest;
use App\Http\Requests\Front\User\UserLoginRequest;
use App\Models\Page;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Khsing\World\Models\City;
use Khsing\World\Models\Country;
use Khsing\World\World;

class AuthController extends Controller
{
    public function auth()
    {
        $page = Page::where('slug', 'auth')->where('status', true)->first();

        if (!$page) {
            abort(404);
        }

        $this->setDefaultData();

        $this->data([
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        return $this->render('auth');
    }

    public function login(UserLoginRequest $request)
    {
        $credentials = $this->getCredentials($request);

        $errors = [];

        $errors = $this->validateLoginFields($credentials, $errors);

        if (!empty($errors)) {
            return redirect()->back()->withInput()->withErrors($errors);
        }

        if (Auth::attempt($this->getCredentials($request))) {
            return redirect(route('front.home'));
        }

        return redirect()->back()->withInput()->withErrors(['password' => [__('site_labels.wrong_password')]]);
    }

    public function register()
    {
        $page = Page::where('slug', 'register')->where('status', true)->first();

        if (!$page) {
            abort(404);
        }

        $this->setDefaultData();

        $countries = World::Countries()->pluck('name', 'code');

        $this->data([
            'countries'        => $countries,
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        return $this->render('register');
    }

    public function register_store(UserCreateRequest $request)
    {
        $data = $request->except('_token');

        $errors = [];

        $errors = $this->validateFields($data, $errors);

        if (!empty($errors)) {
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $country = Country::getByCode($data['country']);

        if ($country) {
            $data['country'] = $country->name;
            $data['country_code'] = $country->code;
        }

        $city = City::find($data['city']);

        if ($city) {
            $data['city'] = $city->name;
            $data['city_code'] = $city->code;
        }

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        Auth::loginUsingId($user->id);

        return redirect(route('front.home'));
    }

    public function restore(Request $request)
    {
        $page = Page::where('slug', 'restore')->where('status', true)->first();

        if (!$page) {
            abort(404);
        }

        $this->setDefaultData();

        $this->data([
            'token' => $request->get('token'),
            'email' => $request->get('email'),
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        return $this->render('restore');
    }

    public function restore_post(RestorePasswordRequest $request)
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            return redirect()->back()->withInput()->withErrors(['restore_error' => __('site_labels.'.$status)]);
        }

        return redirect(route('front.auth'));
    }

    public function reset_view()
    {
        $page = Page::where('slug', 'reset')->where('status', true)->first();

        if (!$page) {
            abort(404);
        }

        $this->data([
            'title'            => $page->title ? $page->title : 'LIFTA OWNED MEDIA',
            'meta_title'       => $page->meta_title ? $page->meta_title : 'LIFTA OWNED MEDIA',
            'description'      => $page->description ? $page->description : 'LIFTA OWNED MEDIA',
            'meta_description' => $page->meta_description ? $page->meta_description : 'LIFTA OWNED MEDIA',
            'image'            => asset('/themes/default/img/sharing.png')
        ]);

        $this->setDefaultData();

        return $this->render('reset');
    }


    public function reset(ResetPasswordRequest $request)
    {
        $credential = $request->get('email');

        $errors = [];

        $errors = $this->validateResetFields($credential, $errors);

        if (!empty($errors)) {
            return redirect()->back()->withInput()->withErrors($errors);
        }

        $user = User::where(function ($q) use ($credential){
            $q->where('email', $credential)->orWhere('phone', $credential);
        })->first();

        try {

            $status = Password::sendResetLink(['email' => $user->email]);

        } catch (\Exception $e) {
            Log::info(['reset_error' => $e->getMessage()]);
            return redirect()->back()->withInput()->withErrors(['reset_error' => __('site_labels.'.$e->getMessage())]);
        }

        if ($status != Password::RESET_LINK_SENT) {
            return redirect()->back()->withInput()->withErrors(['reset_error' => __('site_labels.'.$status)]);
        }

        return redirect(route('front.home'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('front.home'));
    }

    private function getCredentials(Request $request): array
    {
        if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->get('email'), 'password' => $request->get('password')];
        }

        return ['phone' => $request->get('email'), 'password' => $request->get('password')];
    }

    private function validateFields($data, $errors)
    {
        if (isset($data['email'])) {
            $user = User::where('email', $data['email'])->first();

            if ($user) {
                $errors['email'] = [__('site_labels.email_has_already_been_taken')];
            }
        }

        if (isset($data['phone'])) {
            $user = User::where('phone', $data['phone'])->first();

            if ($user) {
                $errors['phone'] = [__('site_labels.phone_has_already_been_taken')];
            }
        }

        return $errors;
    }

    public function validateLoginFields($credentials, $errors)
    {
        if (isset($credentials['phone'])) {
            $user = User::where('phone', $credentials['phone'])->first();

            if (!$user) {
                $errors['phone'] = [__('site_labels.user_with_phone_does_not_exist')];
            }
        }

        if (isset($credentials['email'])) {
            $user = User::where('email', $credentials['email'])->first();

            if (!$user) {
                $errors['email'] = [__('site_labels.user_with_email_does_not_exist')];
            }
        }

        return $errors;
    }

    public function validateResetFields($credential, $errors)
    {
        if (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            $user = User::where('email', $credential)->first();
            if (!$user) {
                $errors['email'] = [__('site_labels.user_with_email_does_not_exist')];
            }
        } else {
            $user = User::where('phone', $credential)->first();
            if (!$user) {
                $errors['phone'] = [__('site_labels.user_with_phone_does_not_exist')];
            }
        }

        return $errors;
    }
}

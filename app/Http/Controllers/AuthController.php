<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\Order;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;
class AuthController extends Controller
{
    public function viewLogin()
    {
        SEOTools::setTitle(__('seo.login.title'));
        SEOTools::setDescription(__('seo.login.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.login.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.login.title'),
            'description' => __('seo.login.description'),
            'url' => url()->current(),
        ]);

        return view('auth.login');
    }

    public function viewRegister()
    {
        SEOTools::setTitle(__('seo.register.title'));
        SEOTools::setDescription(__('seo.register.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.register.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.register.title'),
            'description' => __('seo.register.description'),
            'url' => url()->current(),
        ]);

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 1,
        ]);

        return redirect()->route('login')->with('success', 'messages.registration_successful');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'error' => 'messages.invalid_credentials',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function viewAccount()
    {
        SEOTools::setTitle(__('seo.account.title'));
        SEOTools::setDescription(__('seo.account.description'));
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->setType('website');
        SEOTools::opengraph()->setDescription(__('seo.account.description'));

        JsonLd::addValue([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => __('seo.account.title'),
            'description' => __('seo.account.description'),
            'url' => url()->current(),
        ]);

        $user = Auth::user();

        $orders = Order::where('customer_id', $user->id)
            ->with(['items.productVariant.product.primaryImage', 'items.productVariant.color', 'items.productVariant.size'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.index', compact('user', 'orders'));
    }

    public function viewAddresses()
    {
        $user = Auth::user();
        $addresses = Address::where('customer_id', $user->id)->get();

        return view('account.addresses', compact('user', 'addresses'));
    }
}

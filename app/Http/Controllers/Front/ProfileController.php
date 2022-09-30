<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();

        return $this->render('account.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $dto = $request->all();
        $dto['company_id'] = $user->company->id;

        $user->fill($request->only('name','surname','birthday','contacts'));
        $user->save();

        if ($request->file('avatar')) {
            $image = Storage::disk('files')->putFile(
                'users/' . $user->id,
                $request->file('avatar')
            );
            $user->update(['avatar' => Storage::disk('files')->url($image)]);
        }

        return $request->ajax()
            ? response()->json(['redirect' => route('company.pools')])
            : redirect()->route('company.pools');
    }
}

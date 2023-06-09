<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubscribeController extends Controller
{
    public function subscribe(Request $request)
    {
        $this->validate($request, [
            'email' => [
                'required',
                'email',
                Rule::unique('subscribers', 'email')->where(fn ($query) => $query->where('website_id', $request->input('website_id'))),
            ],
            'website_id' => ['required']
        ]);

        Subscribe::create([
            'website_id' => $request->get('website_id'),
            'email' => $request->get('email')
        ]);

        return response()->json();
    }
}

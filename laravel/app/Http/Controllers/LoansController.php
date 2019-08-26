<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Http\Resources\LoanResource;
use Illuminate\Http\Request;

class LoansController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        return LoanResource::collection(Loan::where('deleted_at', null)->get());
    }

    public function store(Request $request)
    {
        $loan = new Loan;
        $loan->item = $request->input('item', '');
        $loan->whitWHOM = $request->input('whitWHOM', '');
        $loan->direction = $request->input('direction', '');
        if ($loan->item != '' && $loan->whitWHOM != '' && $loan->direction != '') {
            if ($loan->save()) {
                return new LoanResource($loan);
            } else {
                return response('Error 500', 500);
            }
        } else {
            return response('Error 400', 400);
        }
    }

    public function update(Request $request, Loan $loan)
    {
        $loan->item = $request->input('item', '');
        $loan->whitWHOM = $request->input('whitWHOM', '');
        $loan->direction = $request->input('direction', '');
        if ($loan->item == '' || $loan->whitWHOM == '' || $loan->direction == '') {
            return response('Error 400', 400);
        }
        if (!$loan->save()) {
            return response('Error 500', 500);
        }
        if ($request->input('done', false)) {
            $loan->delete();
            return "Reload";
        } else { 
            return new LoanResource($loan);
        }
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
    }
}

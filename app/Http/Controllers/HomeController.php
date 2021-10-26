<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardFound;
use Illuminate\Http\Request;
use DataTables;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function cardFound()
    {
        return view('cardFound');
    }
    public function getCards(Request $request)
    {
        if ($request->ajax()) {
            $data = Card::with('user')->where('is_found', false)->get();
            return Datatables::of($data)
                ->addColumn('image', function ($row) {
                    return '<img src="' . $row->image . '" width="100 px" class="img-rounded" align="center" />';
                })
                ->rawColumns(['image'])
                ->make(true);
        }
    }
    public function getCardsFound(Request $request)
    {
        if ($request->ajax()) {
            $data = CardFound::with('card')->get();
            return Datatables::of($data)
                ->addColumn('card.image', function ($row) {
                    return '<img src="' . $row->card->image . '" width="100 px" class="img-rounded" align="center" />';
                })->addColumn('action', function ($row) {
                    $span = $row->card->is_found == 1 ? 'وجدت' : 'انتضار';
                    return '<a href="/card_found/' . $row->card->id . '" class="btn  btn-info">' .  $span . '</a>
                ';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    }
    public function cardIsFound($card_id)
    {
        $card = Card::find($card_id);
        $card->update([
            'is_found' => !$card->is_found
        ]);
        return back();
    }
}
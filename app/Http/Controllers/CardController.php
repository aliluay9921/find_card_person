<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardFound;
use App\Traits\SendResponse;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    use SendResponse, UploadImage;

    public function getCards()
    {
        return $this->send_response(200, 'تم جلب الكاردات بنجاح', Card::with('user')->where('is_found', false)->get());
    }


    public function addCard(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'address' => 'required',
            'card_name' => 'required',
            'image' => 'required',
            'phone_number' => 'required|min:11|max:11'

        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }

        $card = Card::create([
            'address' => $request['address'],
            'card_name' => $request['card_name'],
            'phone_number' => $request['phone_number'],
            'user_id' => auth()->user()->id,
            'image' => $this->uploadPicture($request['image'], '/images/')
        ]);
        return $this->send_response(200, 'تم اضافة الهوية بنجاح', [], Card::with('user')->find($card->id));
    }

    public function searchCard(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'card_name' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }
        $card = Card::where('card_name', 'LIKE', '%' . $request['card_name'] . '%')->get();
        return $this->send_response(200, 'تم جلب الهوية المطلوبة', [], $card);
    }

    public function isFoundCard(Request $request)
    {
        $request = $request->json()->all();
        $validator = Validator::make($request, [
            'card_id' => 'required|exists:cards,id',
            'address' => 'required',
            'phone_number' => 'required|min:11|max:11',
            'name' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->send_response(401, 'error validation', $validator->errors(), []);
        }
        $add = CardFound::create($request);
        return $this->send_response(200, 'تم ادخال المعلومات سوف تتم مراجعتها لأستلام البطاقة', [], CardFound::with('card')->find($add->id));
    }
}
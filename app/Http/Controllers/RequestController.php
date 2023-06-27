<?php

namespace App\Http\Controllers;

use App\Enums\LogAction;
use App\Enums\Status;
use App\Models\OrderLog;
use App\Models\Product;
use Illuminate\Contracts\Support\MessageProvider;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class RequestController extends Controller
{


    public function index(Request $request) {
        $id = $request->id;
        $requestModel = \App\Models\Request::findOrFail($id);

        return view("request.requestview", ["request" => $requestModel]);
    }

    public function create(Request $request) {

        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email",
            "address" => "required|max:255",
            "product_id" => "exists:products,id",
            "postal" => "required|integer|min:0|max:9993",
            "notes" => "max:1000"
        ]);

        $validated["unique_identifier"] = $uid = md5(microtime()) . md5($validated["product_id"]);
        $product = Product::findOrFail($request->product_id);

        if(!$product->is_available || $product->orders_placed >= $product->max_amount) {
            return to_route("home")->with("error", "Dit design is (tijdelijk) niet meer beschikbaar!");
        }

        $product->orders_placed++;
        $product->save();

        $requestModel = \App\Models\Request::create($validated);

        $log = new OrderLog();
        $log->request_id = $requestModel->id;
        $log->action = LogAction::CREATED_RESERVATION;
        $log->save();


        return redirect("/tracking/" . $uid);
    }

    public function order(Request $request) {

        $product = Product::findOrFail($request->id);

        if(!$product->is_available || $product->orders_placed >= $product->max_amount) {
            return to_route("home")->with("error", "Dit design is (tijdelijk) niet meer beschikbaar!");
        }


        return view("request", ["product" => $product]);
    }

    public function delete(Request $request) {
        $requestModel = \App\Models\Request::findOrFail($request->id);


        if($request->get("refill_stock") !== null && $requestModel->product->orders_placed > 0) {
            $requestModel->product->orders_placed--;
            $requestModel->product->save();
        }

        $log = new OrderLog();
        $log->admin_id = auth()->user()->id;
        $log->request_id = $requestModel->id;
        $log->action = LogAction::DELETED_RESERVATION;
        $log->save();

        $requestModel->delete();
        return to_route("requests");
    }

    public function deletePersonal(Request $request) {
        $requestModel = \App\Models\Request::where("unique_identifier", $request->unique_id)->firstOrFail();


        if($request->status < 1 && $requestModel->product->orders_placed > 0) {
            $requestModel->product->orders_placed--;
            $requestModel->product->save();
        }

        $log = new OrderLog();
        $log->request_id = $requestModel->id;

        $requestModel->delete();

        $log->action = LogAction::CREATED_RESERVATION;
        $log->save();

        return to_route("home")->with("success", "Uw aanvraag is succesvol verwijderd!");
    }

    public function update(Request $request) {

        $validated = $request->validate([
            "status" => [new Enum(Status::class), 'required']
        ]);

        $product = \App\Models\Request::find($request->id)->fill($validated);
        $product->save();

        return back()->with('status', 'request-updated');

    }


}

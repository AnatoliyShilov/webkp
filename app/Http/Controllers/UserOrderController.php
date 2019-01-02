<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserOrder;
use App\PayType;
use App\DeliveryType;
use App\ProductList;
use App\Status;
use App\Type;
use App\Product;
use App\Jobs\Email;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Mail;
use DB;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userorder.index', 
            [
                'userOrders' => UserOrder::orderby('updated_at', 'desc')->get(),
                'types' => Type::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $deliveryTypes = DeliveryType::All();
        $payTypes = PayType::All();
        return view('userorder.create', 
            [
                'deliveryTypes' => $deliveryTypes, 
                'payTypes' => $payTypes,
                'types' => Type::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'address' => 'required',
                'deliverytype' => 'required',
                'paytype' => 'required'
            ]
        );
        $newUserOrder = new UserOrder;
        $newUserOrder->address = $request->input('address');
        $newUserOrder->deliverytype = $request->input('deliverytype');
        $newUserOrder->paytype = $request->input('paytype');
        if (Auth::check())
            $newUserOrder->user = Auth::id();
        else
            return redirect('/home');
        $newUserOrder->save();
        $basket = $request->session()->get('basket');
        if ($basket == null)
            return redirect('/basket');
        foreach ($basket as $element)
        {
            $newProductList = new ProductList;
            $newProductList->userorder = $newUserOrder->id;
            $newProductList->product = $element['product'];
            $newProductList->count = $element['count'];
            $newProductList->save();
        }
        Email::dispatch(new MailController(Auth::user(), $newUserOrder, $basket));
        $request->session()->forget('basket');
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userOrder = UserOrder::find($id);
        if (Auth::id() != $userOrder->user && Auth::user()->role != 0)
            return back();
        $productLists = ProductList::where('userorder', $userOrder->id)->paginate(10);
        $sumOfOrder = Product::select(DB::raw('sum(cost) as sumoforder'))
                            ->whereIn('id', ProductList::select('product')
                                            ->where('userorder',$userOrder->id))
                            ->first()->sumoforder;
        return view('userorder.show', 
            [
                'userOrder' => $userOrder,
                'productLists' => $productLists,
                'types' => Type::all(),
                'sumOfOrder' => $sumOfOrder
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userOrder = UserOrder::find($id);
        $statuses = Status::all();
        return view('userorder.edit', 
            [
                'userOrder' => $userOrder,
                'statuses' => $statuses,
                'types' => Type::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'status' => 'required'
            ]
        );
        $userOrder = UserOrder::find($id);
        $userOrder->status = $request->input('status');
        $userOrder->save();
        return redirect('/userorders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userOrder = UserOrder::find($id);
        $userOrder->delete();
        return redirect('/userorders');
    }
}

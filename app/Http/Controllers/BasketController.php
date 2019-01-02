<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Product;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $basket = session()->get('basket');
        if ($basket == null)
        {
            $basket = [];
        }
        else
        {
            $sumOfOrder = 0;
            foreach ($basket as $element)
                $sumOfOrder += $element['count'] * $element['cost'];
        }
        return view('basket.index', 
            [
                'basket' => $basket, 
                'types' => Type::all(),
                'sumOfOrder' => $sumOfOrder
            ]
        );
    }

    /**
     * Place product in the basket
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function toBasket(Request $request, $id)
    {
        if ($request->input('count') == null)
            $count = 1;
        else
            $count = $request->input('count');
        $basket = $request->session()->get('basket');
        if ($basket == null)
        {
            $request->session()->push(
                'basket', 
                [
                    'product' => $id,
                    'count' => $count,
                    'cost' => Product::find($id)->cost,
                ]
            );
            return redirect()->back();
        }
        if (array_filter($basket, 
                function ($element) use ($id)
                {
                    return ($element['product'] == $id);
                }
            ) == null)
            {
                $request->session()->push(
                    'basket', 
                    [
                        'product' => $id,
                        'count' => $count,
                        'cost' => Product::find($id)->cost,
                    ]
                );
                return redirect()->back();
            }
            return redirect()->back()->withErrors(['productToBasket', 'Товар уже в корзине']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $basket = session('basket');
        if ($basket != null)
        {
            foreach ($basket as $key => $val)
            {
                if ($val['product'] == $id)
                {
                    unset($basket[$key]);
                    session(['basket' => $basket]);
                    break;
                }
            }
        }
        return redirect('/basket');
    }
}

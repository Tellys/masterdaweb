<?php

namespace App\Http\Controllers\API;

use App\Models\PedidosProdutos;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\PedidoResource;
use Illuminate\Support\Facades\Validator;

class PedidosProdutosController extends BaseController
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $PedidosProdutos = PedidosProdutos::all();
    
        /* return json_encode(['data'=>['id'=>1,'name'=>'nome do fulando', 'detail'=>'detail do fulano']]); */
        return $this->sendResponse(PedidoResource::collection($PedidosProdutos), 'Pedido retrieved successfully.');
        //return json_encode($PedidosProdutos, JSON_FORCE_OBJECT);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all(); 
   
        $validator = Validator::make($input, [
            'id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Pedido = PedidosProdutos::create($input);
   
        return $this->sendResponse(new PedidoResource($Pedido), 'Pedido created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Pedido = PedidosProdutos::find($id);
  
        if (is_null($Pedido)) {
            return $this->sendError('Pedido not found.');
        }
   
        return $this->sendResponse(new PedidoResource($Pedido), 'Pedido retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PedidosProdutos $Pedido)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Pedido->name = $input['name'];
        $Pedido->detail = $input['detail'];
        $Pedido->save();
   
        return $this->sendResponse(new PedidoResource($Pedido), 'Pedido updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidosProdutos $Pedido)
    {
        $Pedido->delete();
   
        return $this->sendResponse([], 'Pedido deleted successfully.');
    }
}

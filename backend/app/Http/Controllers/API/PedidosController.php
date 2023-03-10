<?php

namespace App\Http\Controllers\API;

use App\Models\Pedidos;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\PedidoResource;
use App\Models\PedidosProdutos;
use Illuminate\Support\Facades\Validator;

class PedidosController extends BaseController
{
    var $userId; 

    function getUserId($key = 'id'){

        return $this->userId = $this->userToToken($key);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $pedidos = Pedidos::all();
        $pedidoProdutos = [];

        foreach ($pedidos as $k => $v) {
            //return json_encode('k = '. $k.' - v= '.$v);
            $pedidos[$k]['produtos'] = PedidosProdutos::where(['pedidos_id'=>$v->id], ['user_id'=>$this->getUserId()])->get();
            $pedidos[$k]['produtos']['qtd_itens'] = count($pedidos[$k]['produtos']);
            $pedidos[$k]['produtos']['total'] = PedidosProdutos::where(['pedidos_id'=>$v->id], ['user_id'=>$this->getUserId()])->sum('price');
        }

    
        /* return json_encode(['data'=>['id'=>1,'name'=>'nome do fulando', 'detail'=>'detail do fulano']]); */
        return $this->sendResponse(PedidoResource::collection($pedidos), 'Pedidos retrieved successfully.');
        //return json_encode($Pedidos, JSON_FORCE_OBJECT);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /* $user = User::where('api_token', $apiToken)->first();

        $userId = $user->id;         */
        //$userId = Auth::id();

        //return json_encode(['id user', session()->all(), $request->all()]);
/*         $post_data = $request->all();
        if (isset($post_data['user_token'])) {
            [$id, $user_token] = explode('|', $post_data['user_token'], 2);
            $token_data = DB::table('personal_access_tokens')->where('token', hash('sha256', $partner_token))->first();
            $user_id = $user_id->tokenable_id; // !!!THIS ID WE CAN USE TO GET DATA OF YOUR USER!!!
        }

 */  
   
        $pedido = [];

        $input = $request->all(); 
  
        $validator = Validator::make($input, [
            'products_id' => 'required|numeric',
            'price' => 'required|numeric',
            'quantidade' => 'required|numeric',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $pedido = Pedidos::where(['status'=>'1'], ['user_id'=>$this->getUserId()])->get()->last();

        if(!$pedido){
            $pedido = Pedidos::create(['user_id'=>$this->getUserId()]);
            // return json_encode('linha '.__LINE__.' - '.$pedido->id );
//            return $this->sendError('Cadastro duplicado! Já existe o cadastro '.$request->email, $itenDuplicate, 409);
        }

        $request->request->add(['pedidos_id'=>$pedido->id]); //add request        
        $input = $request->all();
        
        //return json_encode($input);
        
        $pedido = PedidosProdutos::create($input);
   
        return $this->sendResponse(new PedidoResource($pedido), 'Produto acrescentado no carrinho com sucesso.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Pedido = Pedidos::find($id);
  
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
    public function update(Request $request, Pedidos $Pedido)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'id' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $Pedido->id = $input['id'];
        $Pedido->status = $input['status'];
        $Pedido->save();
   
        return $this->sendResponse(new PedidoResource($Pedido), 'Pedido fechado com sucesso.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos $Pedido)
    {
        $Pedido->delete();
   
        return $this->sendResponse([], 'Pedido deleted successfully.');
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function listarPedidos(int $id_pedido = null)
    {
        $pedidos = [];

        if($id_pedido){
            $pedidos = Pedidos::where(['id'=>$id_pedido])->get()->last();
        }else{
            $pedidos = Pedidos::all();
        }

        //return $this->sendError('Validation Error.', $validator->errors());  
        return $this->sendResponse(new PedidoResource($pedidos), 'Pedidos listados com sucesso.');
    }
    
}
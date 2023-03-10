<template>
    <templateView>
      <template v-slot:slotPageComponet>
        <h1>Lista de Pedidos</h1>
        <p>Liste os pedidos de nosso banco de dados</p>

        <div v-if="itens.success == true">

          <ul class="list-group list-group-horizontal container "> 
            <li class="col list-group-item d-flex justify-content-between align-items-center">id</li>
            <li class="col list-group-item d-flex justify-content-between align-items-center">Qtd de itens</li>
            <li class="col list-group-item d-flex justify-content-between align-items-center">Total do Pedido</li>
            <li class="col list-group-item d-flex justify-content-between align-items-center">CMD</li>
          </ul>

          <div v-for="vDados in itens.data" :key="vDados.id"> 
            <ul class="list-group list-group-horizontal container"> 
            <li class="col list-group-item d-flex justify-content-between align-items-center" v-text="'id = '+vDados.id"></li>
            <li class="col list-group-item d-flex justify-content-between align-items-center" v-text="'Qtd de itens = '+vDados.produtos.qtd_itens"></li>
            <li class="col list-group-item d-flex justify-content-between align-items-center" v-text="'Total do Pedido = '+vDados.produtos.total"></li>
            <li class="col list-group-item d-flex justify-content-between align-items-center btn-group" role="group" aria-label="Basic mixed styles example">
              <button v-if="vDados.status == 0" type="button" class="btn btn-warning" title="Visualizar Item" >Pedido Fechado</button>
              <button v-if="vDados.status == 1" type="button" class="btn btn-success" title="Visualizar Item" @click="fecharPedido(vDados.id)">Fechar Pedido</button>
              <button class="btn btn-primary" data-bs-toggle="collapse" :href="'#collapseExample'+vDados.id" role="button" aria-expanded="false" aria-controls="collapseExample">+</button>
                  <!-- <button type="button" class="btn btn-warning" title="Editar Item" @click="editItem(vDados.id)">Edt</button> -->
              <!-- <router-link :to="{name:'productsEdit', params:{id:vDados.id}}" custom v-slot="{ btnEditar }">
                <button @click="btnEditar" role="link" class="btn btn-warning" title="Editar Item">Edt</button>
              </router-link> -->
              
              <!-- <router-link :to="{name:'productsEdit', params:{id:vDados.id}}"><button type="button" class="btn btn-warning" title="Editar Item">Edt</button></router-link> -->
            </li>
            </ul>
            <table v-for="vDadosProdutos in vDados.produtos" :key="vDadosProdutos.id" class="collapse col-12 table caption-top table-striped table-hover table-bordered" :id="'collapseExample'+vDados.id">
              <tbody>
              <tr>
                <th scope="col">Id Produto = {{ vDadosProdutos.id }}</th>
                <td>Vlr Produto = {{ vDadosProdutos.price }}</td>
              </tr>
            </tbody>
            </table>
          </div>

        </div>
        <Alert message="Nenhum item para ser exibido" type="warning" v-else  />


            

        <hr>
      </template>
    </templateView>
  </template>
  
  <script>
  import Alert from '@/components/Alert';
  import templateView from '@/views/Template.vue';
  import axios from 'axios';
  import Swal from 'sweetalert2';
  
  export default {
    name: 'PaginaListarPedidos',
    components: {
    templateView,
    Alert
},
    data(){
      return{
        itens:[],
        //response:[],
      }
    },
    mounted(){
      this.getItens();
    },
    methods:{
      async getItens(){
        //const response = await axios.get('https://jsonplaceholder.typicode.com/users');
        const response = await axios.get('pedidos');
        console.log(response);
        this.itens = response.data;
      },
      async fecharPedido(id){
        Swal.fire({
          title: 'Confirma o fechamento do pedido?',
          showDenyButton: true,
          showCancelButton: true,
          confirmButtonText: 'Sim',
          denyButtonText: 'Não',
          customClass: {
            actions: 'my-actions',
            cancelButton: 'order-1 right-gap',
            confirmButton: 'order-2',
            denyButton: 'order-3',
          }
        }).then((result) => {
          if (result.isConfirmed) {
            axios.patch('pedidos/'+id, {id: id, status: "0"} )
            .then((response) => {
              console.log(response);
              if (response.status === 200) {
                Swal.fire({
                  title: 'Pedido Fechado com sucesso',
                  icon: 'success',                        
                  });
              }else{
                Swal.fire({
                  title: 'OPPS',
                  text: response.data.message,
                  icon: 'warning',                      
                });
              }
              this.getItens();
            })
          } /* else if (result.isDenied) {
            Swal.fire('Changes are not saved', '', 'info')
          } */
        }).then(() => {
          this.getItens();
        })
      }
    }
  }
  
  //this.isLoading = false 
  </script>
  
  <style  scoped>
  .hiddenRow {
    padding: 0 !important;
}
  </style>
  
  
  
  
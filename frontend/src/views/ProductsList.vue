<template>
    <templateView>
      <template v-slot:slotPageComponet>
        <h1>Lista de Produtos</h1>
        <p>Liste os produtos de nosso banco de dados, podendo exitar ou excluir os itens</p>
            <table class="table caption-top table-striped table-hover" v-if="itens.success == true">
            <caption>Lista de Produtos</caption>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Detalhes</th>
                <th scope="col">Preço</th>
                <th scope="col">Estoque</th>
                <th scope="col">Cmd</th>                
                </tr>
            </thead>
            <tbody>
                <tr v-for="vDados in itens.data" :key="vDados.id">
                    <th scope="row">{{ vDados.id }}</th>
                    <td>{{ vDados.name }}</td>
                    <td>{{ vDados.detail }}</td>
                    <td>{{ vDados.price}}</td>
                    <td>{{ vDados.estoque}}</td>
                    <td>
                      <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-primary" title="Visualizar Item" @click="viewItem(vDados.id)">Ver</button>
                        <button type="button" class="btn btn-danger" title="Excluir Item" @click="deleteItem(vDados.id)">X</button>
                        <!-- <button type="button" class="btn btn-warning" title="Editar Item" @click="editItem(vDados.id)">Edt</button> -->
                        <!-- <router-link :to="{name:'productsEdit', params:{id:vDados.id}}" custom v-slot="{ btnEditar }">
                          <button @click="btnEditar" role="link" class="btn btn-warning" title="Editar Item">Edt</button>
                        </router-link> -->
                        
                        <!-- <router-link :to="{name:'productsEdit', params:{id:vDados.id}}"><button type="button" class="btn btn-warning" title="Editar Item">Edt</button></router-link> -->
                      </div>
                    </td>
                </tr>
            </tbody>
            </table>

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
    name: 'ProductsList',
    components: {
      templateView,
      Alert,
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
        const response = await axios.get('products');
        console.log(response);
        this.itens = response.data;
      },
      async editItem(id){
        this.$router.push('/products/'+id+'/edit');
      },
      async viewItem(id){
        this.$router.push('/products/'+id);
      },
      async deleteItem(id){
        Swal.fire({
          title: 'Confirma a exlusão do item?',
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
            axios.delete('products/'+id )
            .then((response) => {
              if (response.status === 200) {
                Swal.fire({
                  title: 'Item Deletado',
                  icon: 'success',                        
                  });
              }else{
                Swal.fire({
                  title: 'OPPS',
                  text: response.data.message,
                  icon: 'warning',                      
                });
              }
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
  
  <style lang="scss" scoped>
  //@import "@/assets/scss/style";
  
  </style>
  
  
  
  
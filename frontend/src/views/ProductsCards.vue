<template>
  <templateView>
    <template v-slot:slotPageComponet>
      <h1>Produtos</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <Card :dados="itens" v-if="itens.success == true" />
            <Alert message="Nenhum item para ser exibido" type="warning" v-else />
        </div>
      <hr>
    </template>
  </templateView>
</template>

<script>
// @ is an alias to /src
import Alert from '@/components/Alert';
import Card from '@/components/Card.vue';
import templateView from '@/views/Template.vue';
import axios from 'axios';

export default {
  name: 'ProductsCards',
  components: {
    Card,
    templateView,
    Alert,
  },
  data(){
    return{
      itens:[]
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
    }
  }
}
//this.isLoading = false 
</script>
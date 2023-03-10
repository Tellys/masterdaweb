<template>
  <div>
    <templateView>
      <template v-slot:slotPageComponet>

        <div class="home">
          <h1>Cards page</h1>
          <card :title="'Titulo 01'" :text="'loren spum'" :price="'1,50'"/>
          <card :title="'Titulo 02'" :text="'loren spum'" :price="'3,70'"/>
          <card :title="'Titulo 03'" :text="'loren spum'" :price="'6,80'"/>
          <card :title="'Titulo 04'" :text="'loren spum'" :price="'9,30'"/>

          <hr>
          <UsersListComponent :users="users" title="Usuários" :columns="['Id', 'Nome', 'User Name', 'E-mail']"/>
          
        </div>

      </template>
    </templateView>
  </div>
</template>

<script>
// @ is an alias to /src
import card from '@/components/Card.vue';
import templateView from '@/views/Template.vue';
import UsersListComponent from '@/views/Users/UsersListComponent.vue';

const axios = require('axios');

export default {
  name: 'cardsView',
  components: {
    templateView,
    card,
    UsersListComponent,
  },
  data(){
    return{
      users:[]
    }
  },
  mounted(){
    this.getUsers();
  },
  methods:{
    async getUsers(){
      const response = await axios.get('https://jsonplaceholder.typicode.com/users');
      //console.log(response.data);
      this.users = response.data;
    }
  }
}
</script>

<style lang="scss" scoped>
@import "@/assets/scss/style";

</style>
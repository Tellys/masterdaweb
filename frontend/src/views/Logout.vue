<template>
  <templateView>
    <template v-slot:slotPageComponet>
      Você não esta mais logado
    </template>
  </templateView>
</template>

<script>
// @ is an alias to /src
import templateView from '@/views/Template.vue';


export default {
  name: 'LogoutView',
  components: {
    templateView
  }
}
</script>
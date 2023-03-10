<template>
  <templateView>
    <template v-slot:slotPageComponet>Pagina perfil
    </template>
  </templateView>
</template>

<script>
// @ is an alias to /src
import templateView from '@/views/Template.vue';

export default {
  name: 'profileView',
  components: {
    templateView,
  }
}
</script>

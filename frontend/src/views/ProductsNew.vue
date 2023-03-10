<template>
    <templateView>
        <template v-slot:slotPageComponet>
            <section>
                <div class="container py-5 h-100">
                    <div class="row d-flex align-items-center justify-content-center h-100">
                        <h1 class="text-center">Cadastrar Novo Produto</h1>
                        <p class="text-center">Cadastrar Novos Produtos em nossa base de dados.</p>

                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                            <form @submit.prevent='registerProduct'>
                                <!-- Name input -->
                                <div class="form-outline mb-4">
                                    <input type="text" id="name" class="form-control form-control-lg"
                                        v-model="register.name" required autofocus />
                                    <label class="form-label" for="name">Nome</label>
                                </div>

                                <!-- Price input -->
                                <div class="form-outline mb-4">
                                    <input type="number" step=".01" min="0" id="price" class="form-control form-control-lg"
                                        v-model="register.price" required  />
                                    <label class="form-label" for="price">Preço</label>
                                </div>

                                <!-- Estoque input -->
                                <div class="form-outline mb-4">
                                    <input type="number" step="1" min="0" id="estoque" class="form-control form-control-lg"
                                        v-model="register.estoque" required  />
                                    <label class="form-label" for="estoque">Estoque</label>
                                </div>

                                <!-- Detail input -->
                                <div class="form-outline mb-4">
                                    <textarea id="detail" class="form-control form-control-lg"
                                     v-model="register.detail" required></textarea>
                                    <label class="form-label" for="detail">Detalhes</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="col-12 btn btn-primary btn-lg btn-block">Salvar</button>

                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </templateView>
</template>

<script>
import axios from 'axios';
import templateView from '@/views/Template.vue';
import Swal from 'sweetalert2';

export default {
    name: 'ProductsNew',
    components: {
        templateView,
    },
    data() {
        return {
            register: {
                name: "",
                price: "",
                estoque: "",
                detail:"",
            },
            error: "",
            data:[],
        }
    },
    methods: {
        registerProduct() {
            axios.post('products', this.register)
                .then((response) => {
                    this.error = false;
                    this.data = response.data;
                    console.log(response);

                    if (response.status=== 200) {
                        Swal.fire({
                            title: 'Sucesso',
                            text:   response.data.message,
                            icon: 'success',                        
                        }).then                                        
                        {this.$router.push({ path: '/products/list' });}
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'OPPS',
                        text:   error.response.data.message,
                        icon: 'warning',                        
                    });
                    
                    this.data = '';
                    this.error = {
                        status: error.response.data.message,
                        message: error.response.data.message
                    };
                    console.log(error.response);
                })
        },
    }
}
</script>
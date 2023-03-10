<template>
    <templateView>
        <template v-slot:slotPageComponet>
            <section>
                <div class="container mt-5 mb-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="images p-3">
                                            <div class="text-center p-4"> <img id="main-image" src="@/assets/placeholder-image.png" width="250" /> </div>
                                            <!-- <div class="thumbnail text-center"> <img onclick="change_image(this)" src="https://i.imgur.com/Rx7uKd0.jpg" width="70"> <img onclick="change_image(this)" src="https://i.imgur.com/Dhebu4F.jpg" width="70"> </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="product p-4">
                                            <!-- <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span class="ml-1">Back</span> </div> <i class="fa fa-shopping-cart text-muted"></i>
                                            </div> -->
                                            <div class="mt-4 mb-3"> <span class="text-uppercase text-muted brand">Marca do Item</span>
                                                <h5 class="text-uppercase">{{ data.name }}</h5>
                                                <div class=""> 
                                                    <div class="w-100 display-4 act-price">R$ {{ data.price }}</div>
                                                    <div class="w-100 text-left"> Estoque:<span>{{ data.estoque }}</span> </div>
                                                </div>
                                            </div>
                                            <p class="about">{{ data.detail }}</p>
                                            <button class="btn btn-danger text-uppercase mr-2 px-4" @click="comprarItem(data.id, data.price, 1)">Comprar</button> <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
    name: 'ProductsDetail',
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
                id: this.$route.params.id,
            },
            error: "",
            data:[],
            id: this.$route.params.id,
        }
    },
    mounted(){
        this.getItens();
    },
    methods: {  
        comprarItem(id, price, quantidade){
            axios.post('pedidos', {'products_id':id, 'price':price, 'quantidade':quantidade})
                .then(response => {
                    this.error = false;
                    this.data = response.data;
                    console.log(response);

                    if (response.status=== 200) {
                        Swal.fire({
                            title: 'Sucesso',
                            text:   response.data.message,
                            icon: 'success',                        
                        })
                        // .then(function () {
                        //     this.$router.push('/products');
                        // })
                        ;                                           
                    }
                    this.getItens();

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
                this.getItens();

        },   
        async getItens(){
            const response = await axios.get('products/'+this.id
            //             {
            //   params: {
            //     id: this.id
            //   }
            // }
             );
            console.log(response);

            if (response.status === 200) {
                /* if(response.data.data){
                    response.data.data = '['+response.data.data+']';
                    console.log('linha 66',response);
                } */
                this.data = response.data.data;
            }else{
                Swal.fire({
                    title: 'OPPS',
                    text:   response.data.message,
                    icon: 'warning',                      
                });
            }
        //await this.$router.push('/product/list');
        }
    }
}
</script>
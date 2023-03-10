<template>
    <section class="vh-100">
        <div class="container py-5">
            <div class="row d-flex align-items-center justify-content-center h-100">
            <!-- <div class="col-md-8 col-lg-7 col-xl-6 d-none d-md-block d-lg-block">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                class="img-fluid" alt="Phone image">
            </div> -->
            <!-- <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1"> -->
            <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">                
                <form @submit.prevent="login">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="formLoginLabelEmail" class="form-control form-control-lg" v-model="register.email" required autofocus/>
                    <label class="form-label" for="formLoginLabelEmail">Email</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="formLoginLabelSenha" class="form-control form-control-lg" v-model="register.password" required/>
                    <label class="form-label" for="formLoginLabelSenha">Senha</label>
                </div>

                <div class="d-flex justify-content-around align-items-center mb-4">
                    <!-- Checkbox -->
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="formLoginLabelRemember" checked />
                    <label class="form-check-label" for="formLoginLabelRemember"> Deixar Logado </label>
                    </div>
                    <router-link to="/esqueci-minha-senha">Esqueceu a senha?</router-link>
                    <router-link to="/user/register">Quero me cadastrar</router-link>
                </div>

                <!-- Submit button -->
                <button type="submit" class="col-12 btn btn-primary btn-lg btn-block">Entrar</button>

                <!-- <div class="col-12 divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">OU</p>
                </div>

                <a class="col-12 btn btn-primary btn-lg btn-block my-2" style="background-color: #3b5998" href="#!" role="button">
                    <i class="fab fa-facebook-f me-2"></i>Login com Facebook
                </a>
                <a class="col-12 btn btn-primary btn-lg btn-block my-2" style="background-color: #55acee" href="#!" role="button">
                    <i class="fab fa-twitter me-2"></i>Login com Twitter</a> -->

                </form>
            </div>
            </div>
        </div>
        </section>
    
</template>

<script>
/* import { ref } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import Swal from 'sweetalert2';

export default {
  name: 'Login',
  setup() {
    const email = ref('');
    const password = ref('');
    const router = useRouter();
    
    const submit = async () => {
      const response = await axios.post('login', {
        email: email.value,
        password: password.value,
      });
    if (response.status !== 200) {
        Swal.fire({
            title: 'Erro',
            text:   response.data.message,
            icon: 'success',                        
        });                                           
    }
    console.log('linha 95', response.data.data.token);
    localStorage.setItem('token', response.data.data.token);
      await router.push({ path: '/' });
    };

    return {
      email,
      password,
      submit,
    };
  },
};
 */


import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: 'LoginComponent',
    components: {
    },
    data() {
        return {
            register: {
                email: "",
                password: "",
            },
            error: "",
            data:[],
        }
    },
    methods: {
        login() {
            axios.post('login', this.register)
                .then((response) => {
                    this.error = false;
                    this.data = response.data;
                    //console.log(response);

                    if (response.status=== 200) {
                        localStorage.setItem('token', response.data.data.token);

                        Swal.fire({
                            title: 'Sucesso',
                            text:   response.data.message,
                            icon: 'success',                        
                        }).then                                        
                        {this.$router.push({ path: '/' });}
                    }
                }, (error) => {
                    if(error.response){
                        error = error.response.data.message;
                    }
                    Swal.fire({ 
                        title: 'OPPS',
                        text:   error,
                        icon: 'warning',                        
                    });
                    
/*                     this.data = '';
                    this.error = {
                        status: error.response.data.message,
                        message: error.response.data.message
                    };
 */                    
                    //console.log(error.response);
                })
        },
    },

}
</script>

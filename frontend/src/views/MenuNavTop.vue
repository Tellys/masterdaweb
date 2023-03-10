<template>
  
  <nav class="navbar navbar-expand-sm " aria-label="Menu" style="background-color: #6f42c1;">
      <div class="container">
        <router-link to="/" class="navbar-brand">
          <img src="../assets/logo-white-blue.png" alt="Logomarca" width="200" > 
        </router-link>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="true" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample03" style="">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link class="me-3 nav-link active text-white" to="/">Home</router-link>
            </li>
            <li class="nav-item">
              <router-link class="me-3 nav-link text-white" to="/about">About</router-link>
            </li>
            <li class="nav-item">
              <router-link class="me-3 nav-link text-white" to="/profile">Profile</router-link>
            </li>
            <li class="nav-item">
              <router-link class="me-3 nav-link text-white" to="/login">Login</router-link>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
              <ul class="dropdown-menu">
                <li><router-link to="/products" class="dropdown-item">Grid</router-link></li>
                <li><router-link to="/products/list" class="dropdown-item">Listar</router-link></li>
                <li><router-link to="/products/new" class="dropdown-item">Incluir Novo</router-link></li>
                <li><router-link to="/products/list" class="dropdown-item">Editar / Exluir</router-link></li>
              </ul>
            </li>
            <li class="nav-item">
              <router-link class="me-3 nav-link text-white" to="/listar-pedidos">Listar Pedidos</router-link>
            </li>
            
            <!-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li> -->
            <li class="nav-item">
              <router-link class="me-3 nav-link text-white" to="/logout">Sair</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>

  <router-view/>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
  name: 'MenuNavTop',
    components: {
    },
    methods: {  
        logout(){
            axios.get('/logout')
                .then(response => {
                    console.log(response);
                    if (response.status=== 200) {
                        Swal.fire({
                            title: 'Sucesso',
                            text:   response.data.message,
                            icon: 'success',                        
                        })
                        .then(() => {
                          this.$router.push({ path: '/' });
                        })
                        // .then(function () {
                        //     this.$router.push('/products');
                        // })
                        ;                                           
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'OPPS',
                        text:   error.response.data.message,
                        icon: 'warning',                        
                    });
                    console.log(error.response);
                })
        }
    }
}
</script>
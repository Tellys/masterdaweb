import { createRouter, createWebHistory } from 'vue-router'
//import PaginaHome from '../views/Home.vue'
import PaginaProfile from '../views/Profile.vue'
import PaginaLogin from '../views/Login.vue'
import PaginaLogout from '../views/Logout.vue'
import PaginaCards from '../views/Cards.vue'
import PaginaProducts from '../views/ProductsCards.vue'
import PaginaProductsList from '../views/ProductsList.vue'
import PaginaProductsNew from '../views/ProductsNew.vue'
import PaginaProductsEdit from '../views/ProductsEdit.vue'
import PaginaProductsDetail from '../views/ProductsDetail.vue'
import PaginaRegister from '../views/Register.vue'
import PaginaListarPedidos from '../views/PaginaListarPedidos.vue'



/* const router = createRouter({
  history: createWebHistory('configure-admin'), <-- this works
  // base: 'configure-admin', <-- this does not work in vue 3
  routes: routes,
  linkActiveClass: 'active'
}); */
const routes = [
  {
    path: '/',
    name: 'home',
    component: PaginaProducts
  },
  {
    path: '/profile',
    name: 'profile',
    component: PaginaProfile,
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/login',
    name: 'login',
    component: PaginaLogin,
  },
  {
    path: '/logout',
    name: 'logout',
    component: PaginaLogout,
  },
  {
    path: '/cards',
    name: 'cards',
    component: PaginaCards,
  }, 
  {
    path: '/products',
    name: 'products',
    component: PaginaProducts,
    //  children: [{ path: 'settings', component: AdminSettings }],
  },
  {
    path: '/products/list',
    name: 'productsList',
    component: PaginaProductsList,
  }, 
  {
    path: "/products/:id",
    props: true,
    component: PaginaProductsDetail,
    children:[
      {
        ///products/:id/edit
        name: 'productsEdit',
        path: "edit",
        component: PaginaProductsEdit,
      }
    ]

  }, 
  {
    path: '/products/new',
    name: 'productsNew',
    component: PaginaProductsNew,
  }, 
  {
    path: '/user/register',
    name: 'userRegister',
    component: PaginaRegister,
  },
  {
    path: '/listar-pedidos',
    name: 'listarPedidos',
    component: PaginaListarPedidos,
  },
]


const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
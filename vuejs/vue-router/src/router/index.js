import { createRouter, createWebHistory } from 'vue-router'
import Profile from '../views/Profile.vue'
import Product from '../views/Product.vue'

const routes = [
  
  {
    path: '/profile',
    name: 'profile',
    component: Profile,
  },
  {
    path: '/product/:id/:category',
    name: 'product',
    component: Product
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})


export default router


import Vue from 'vue'
import Router from 'vue-router'
import Index from "@/views/Index.vue"
import Login from "@/views/Login.vue"
import Regist from "@/views/Regist.vue"


Vue.use(Router)

export default new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path:'/',
      name:'index',
      component:Index,
      children:[
        {
          path:'',
          name:'index',
          component:()=>import('@/views/index/Index.vue')
        },
        {
          path:'/cate',
          name:'cate',
          component:()=>import('@/views/index/Cate.vue')
        },
        {
          path:'/cart',
          name:'cart',
          component:()=>import('@/views/index/Cart.vue')
        },
        {
          path:'/person',
          name:'person',
          component:()=>import('@/views/index/Person.vue')
        }
      ]
    },
    {
      path:'/login',
      name:'login',
      component:Login
    },
    {
      path:'/regist',
      name:'regist',
      component:Regist
    }
  ]
})

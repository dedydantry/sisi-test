import {createRouter,createWebHistory} from 'vue-router'
import Cookies from 'js-cookie'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/app',
      component:() => import('../layouts/Main.vue'),
      name:'app',
      children: [
        {
          path: '',
          name: 'dashboard',
          component: () => import('../pages/Index.vue'),
          meta:{
            pageTitle:'Dashboard',
            requiresAuth:true
          }
        },
        {
          path: 'user',
          name: 'user',
          component: () => import('../pages/user/Index.vue'),
          meta:{
            pageTitle:'User',
            requiresAuth:true
          }
        },
        {
          path: 'menu',
          name: 'menu',
          component: () => import('../pages/menu/Index.vue'),
          meta:{
            pageTitle:'Menu',
            requiresAuth:true
          }
        },
        {
          path: 'error-log',
          name: 'error-log',
          component: () => import('../pages/ErrorLog.vue'),
          meta:{
            pageTitle:'Error Log',
            requiresAuth:true
          }
        },
        {
          path: 'activity',
          name: 'activity',
          component: () => import('../pages/Activity.vue'),
          meta:{
            pageTitle:'User activity',
            requiresAuth:true
          }
        },
        {
          path: 'profil',
          name: 'profil',
          component: () => import('../pages/Profil.vue'),
          meta:{
            pageTitle:'Profil',
            requiresAuth:true
          }
        },
        {
          path: 'about',
          name: 'about',
          component: () => import('../pages/About.vue'),
          meta:{
            pageTitle:'About',
            requiresAuth:true
          }
        },
      ],
    },
    {
      path:'/login',
      name:'login',
      component:() => import('../pages/Login.vue'),
      meta:{
          pageTitle:'Login',
          guest:true
      }
    }
  ]
})
const isLogin = Cookies.get('access_token')
router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if(!isLogin){
      return next({
        path: '/login',
        params: { nextUrl: to.fullPath }
      })
    }
  }else if (to.matched.some(record => record.meta.guest)) {
    if(isLogin){
        return next({
          path: '/app',
          params: { nextUrl: to.fullPath }
        })
    }
  }
  return next()
})


export default router
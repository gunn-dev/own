import VueRouter from 'vue-router'

const router = new VueRouter({
  mode: 'history',
  routes: [ 
  {
    path: '/',
    component: ()=> import(/* webpackChunkName: "home" */ '../components/Home.vue')
  },
  {
    path: '/settings',
    component: () => import(/* webpackChunkName: "settings" */ '../components/UserSettings.vue'),
    children: [{
      path: 'email/:id',
      component: ()=> import(/* webpackChunkName: "email" */ '../components/UserEmailsSubscriptions.vue'),
      props: true
    },{
      path: 'profile',
      name: 'profile',
      components: {
        default: ()=> import(/* webpackChunkName: "profile" */ '../components/UserProfile.vue'),
        helper: ()=> import(/* webpackChunkName: "profilepreview" */ '../components/UserProfilePreview.vue')
      },
      props: true
    }]
  }
  ],
})

export default router
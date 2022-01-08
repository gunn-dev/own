import Vue from 'vue'
import App from './App.vue'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import store from './store/index.js'

Vue.config.productionTip = false

new Vue({
  render: h => h(App), store
}).$mount('#app')

// console.log(store.getters.getTodoById(1));
// store.commit('payloadIncrement', {
//   amount: 20
// })
// store.commit({
//   type: 'payloadIncrement',
//   amount: 2
// })
// store.dispatch('increment')
// store.dispatch({
//   type: 'a/payloadIncrementAsync',
//   amount: 5
// })

// console.log(store.state.a.count)
// console.log(store.state.b.count)

store.commit('NUM_INCREMENT');
store.commit('NUM_INCREMENT');
store.commit('NUM_INCREMENT');

// console.log(store.state.num);
store.commit('NUM_DECREMENT');
// console.eplanetlog(store.state.num);
store.commit('PAYLOAD_INCREMENT', {
  amount: 10
})
console.log(store.state.num)

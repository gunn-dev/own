import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        count: 0
    },
    mutations: {
        increment (state) {
            state.count++
        },
        incrementBy (state, payload) {
            state.count += payload.amount
        }
    }
});

import { mapState, mapMutations } from 'vuex';

new Vue({ 
    el: '#app',
    store,
    data: {
    },
    computed: mapState([
        'count'
    ]),
    methods: mapMutations([
        'increment',
        'incrementBy'
    ])
});

// store.commit({
//     type: 'incrementBy',
//     amount: 40
// })
// store.commit('incrementBy', { amount: 29 });
// console.log(store.state.count);

// Vue.set(obj, 'new prop', 123)
// state.obj = { ...state.obj, newProp: 123 }
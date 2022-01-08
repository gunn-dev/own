import { createApp } from 'vue'
import { createStore } from 'vuex'
import App from './App.vue'


const store = createStore({
	state: {
		flavor: ''
	},
	mutations: {
		change(state, flavor) {
			state.flavor = flavor
		}
	},
	getters: {
		flabor: state => state.flavor
	}
});

const app = createApp({App})
app.use(store)
